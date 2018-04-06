<?php
use CRM_Wachtdienstimport_ExtensionUtil as E;

class CRM_Wachtdienstimport_Page_UploadResult extends CRM_Core_Page {

  private function failures(){
    $failures = array();
    $dao = CRM_Core_DAO::executeQuery("
      select imp.id,imp.contact_id,imp.contact_name,imp.message from import_wachtdienst imp");
    while($dao->fetch()){
      $row = array(
        'id' => $dao->id,
        'contact_id' => $dao->contact_id,
        'contact_naam' => $dao->contact_name,
        'message' => unserialize($dao ->message)
      );
      $failures[]=$row;
    }
    return $failures;
  }

  public function run() {
    // Example: Set the page-title dynamically; alternatively, declare a static title in xml/Menu/*.xml
    CRM_Utils_System::setTitle(E::ts('UploadResult'));

    // Example: Assign a variable for use in a template
    $this->assign('failures',$this->failures());

    parent::run();
  }

}
