<?php
/**
 * Uitvallijst van de wachtdienst upload
 *
 * @author Klaas Eikelbooml (CiviCooP) <klaas.eikelboom@civicoop.org>
 * @date 3-april-2018
 * @license AGPL-3.0
 *
 */
use CRM_Wachtdienstimport_ExtensionUtil as E;

class CRM_Wachtdienstimport_Page_UploadResult extends CRM_Core_Page {

  /**
   * @return array
   */
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

  /**
   * @return null|void
   */
  public function run() {
    CRM_Utils_System::setTitle(E::ts('Uitvallijst wachtdienst import'));
    $this->assign('failures',$this->failures());
    parent::run();
  }

}
