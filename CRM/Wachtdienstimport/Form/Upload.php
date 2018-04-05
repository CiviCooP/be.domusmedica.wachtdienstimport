<?php

use CRM_Wachtdienstimport_ExtensionUtil as E;

/**
 * Form controller class
 *
 * @see https://wiki.civicrm.org/confluence/display/CRMDOC/QuickForm+Reference
 */
class CRM_Wachtdienstimport_Form_Upload extends CRM_Core_Form {

  public function buildQuickForm()
  {

    $maxFileSize = Civi::settings()->get('maxFileSize');
    $uploadFileSize = CRM_Utils_Number::formatUnitSize($maxFileSize . 'm', TRUE);
    //Fetch uploadFileSize from php_ini when $config->maxFileSize is set to "no limit".
    if (empty($uploadFileSize)) {
      $uploadFileSize = CRM_Utils_Number::formatUnitSize(ini_get('upload_max_filesize'), TRUE);
    }
    $uploadSize = round(($uploadFileSize / (1024 * 1024)), 2);
    $this->assign('uploadSize', $uploadSize);
    $this->add('File', 'uploadFile', ts('Import Data File'), 'size=30 maxlength=255', TRUE);
    $this->setMaxFileSize($uploadFileSize);
    $this->addRule('uploadFile', ts('File size should be less than %1 MBytes (%2 bytes)', array(
      1 => $uploadSize,
      2 => $uploadFileSize,
    )), 'maxfilesize', $uploadFileSize);
    // $this->addRule('uploadFile', ts('Input file must be in CSV format'), 'utf8File');
    // $this->addRule('uploadFile', ts('A valid file must be uploaded.'), 'uploadedfile');
    $this->addButtons(array(
      array(
        'type' => 'submit',
        'name' => E::ts('Submit'),
        'isDefault' => TRUE,
      ),
    ));
    CRM_Utils_System::setTitle(E::ts('Import van wachtdienst activiteiten'));
    parent::buildQuickForm();
  }

  public function preProcess()
  {
    if (isset($this->_submitFiles['uploadFile'])) {
      $uploadFile = $this->_submitFiles['uploadFile'];
      $importer = new CRM_Wachtdienstimport_Importer();
      $importer ->truncate();
      $importer -> importCVStoTable($uploadFile['tmp_name']);
    }
  }

  public function postProcess() {

    $processor = new CRM_Wachtdienstimport_Processor();

    $queue = CRM_Queue_Service::singleton()->create(array(
      'type' => 'Sql',
      'name' => 'be.domusmedica.wachtdienstimport',
      'reset' => TRUE, //do not flush queue upon creation
    ));


    $processor->fillQueue($queue);

    $url = CRM_Utils_System::url('civicrm/wachtdienstimport/uploadresult', 'reset=1');;
    $runner = new CRM_Queue_Runner(array(
      'title' => ts('Verwerk de aangeleverde wachtdienstactiviteiten'), //title fo the queue
      'queue' => $queue, //the queue object
      'errorMode'=> CRM_Queue_Runner::ERROR_ABORT, //abort upon error and keep task in queue
      'onEnd' => array($this, 'onEnd'), //method which is called as soon as the queue is finished
      'onEndUrl' => $url,
    ));
    $runner->runAllViaWeb(); // does not return

    parent::postProcess();
  }


}
