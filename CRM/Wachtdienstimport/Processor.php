<?php

/**
 * Process the permaned table with the civicrm_api3
 *
 * @author Klaas Eikelbooml (CiviCooP) <klaas.eikelboom@civicoop.org>
 * @date 4-jan-2018
 * @license AGPL-3.0
 *
 */
class CRM_Wachtdienstimport_Processor {

  private $stepsize;

  /**
   * CRM_Wachtdienstimport_Processor.
   *
   * @param $stepsize
   */
  public function __construct($stepsize = 10) {
    $this->stepsize = $stepsize;
  }

  private function calcSteps() {
    $calcRows = CRM_Core_DAO::singleValueQuery('SELECT count(1) FROM import_wachtdienst WHERE processed = %1', array(
      '1' => array('N', 'String'),
    ));
    return ceil($calcRows / $this->stepsize);
  }


  public function process(CRM_Queue_TaskContext $ctx) {
    $dao = CRM_Core_DAO::executeQuery('SELECT * FROM import_wachtdienst WHERE processed = %1 LIMIT %2', array(
      '1' => array('N', 'String'),
      '2' => array($this->stepsize, 'Integer'),
    ));
    try {
      while ($dao->fetch()) {
        $this->processRecord($dao);
      }
    } catch (Exception $ex) {
      Civi::log()->info($ex);
    }
    return TRUE;
  }

  public function fillQueue($queue) {
    $calcSteps = $this->calcSteps();
    for ($i = 0; $i <= $calcSteps; $i++) {
      $task = new CRM_Queue_Task(
        array(
          $this,
          'process',
        ), //call back method
        array(), //parameters,
        "Processed " . $i * $this->stepsize . " rows"
      );
      $queue->createItem($task);
    }
  }

  /**
   * @param $dao
   */
  private function processRecord($dao) {

    /* the array errors is used by the processing
       functions to store errors so they can be
       examined later. Now all the processing functions skip
       processing if they find and error.
    */
    $errors = array();
    /* warnings function the same way as errors, except that
       generating a warning does not stop the processing
       (however it is reported back)
    */
    $warnings = array();
    /* context is used to pass technical keys from on
       processing function to another. At the moment two
       keys are passed
       - contact_id  id of the arts
       - praktijk_id is (id of the connected organization
    */
    $context = array();

    try {

      /* processing functions have all the same structure
         - check for errors - if so skip
         - check if the field that must me updated is in
           the input - if so skip
         - look if the object to be created already exists
           finds its technical id.
         - create or update the object (using the api and its id)
         - fill the context if needed
         - fill the errors
         - return

         however there are differences how the functions map
         the import table fields to the api arguments

         1) a specialist functions does the mapping inside the
            function (such a function is used one time e.g
            procesPraktijk.
         2) a generic function does the mapping outside the function
            (below, example processEmail)
      */

      $this->processCheck($dao, $errors);
    } catch (Exception $ex) {
      $errors[] = $ex;
    }
    if (empty($errors+$warnings)) {
      CRM_Core_DAO::executeQuery('UPDATE import_wachtdienst SET processed = %2 WHERE id=%1', array(
        1 => array($dao->id, 'Integer'),
        2 => array('S', 'String'),
      ));
    }
    else {
      $message = implode($errors+$warnings, ';');
      CRM_Core_DAO::executeQuery('UPDATE import_wachtdienst SET processed = %2, message=%3 WHERE id=%1', array(
        1 => array($dao->id, 'Integer'),
        2 => array('F', 'String'),
        3 => array($message, 'String'),
      ));
    }


  }

  /**
   * @param $dao
   * @param $errors
   */
  private function processCheck($dao, &$errors) {
    if (!empty($errors)) {
      return;
    }

  }
}