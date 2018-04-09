<?php
/**
 * Configuratie signleton, eenmalig lezen van configuratie constanten
 *
 * @author Klaas Eikelbooml (CiviCooP) <klaas.eikelboom@civicoop.org>
 * @date 3-april-2018
 * @license AGPL-3.0
 *
 */

class CRM_Wachtdienstimport_Config {

  private $_eindDatumTijdCustomFieldId;

  private static $_singleton;

  /**
   * CRM_Wachtdienstimport_Config constructor.
   */
  public function __construct() {
    try {
      $this->_eindDatumTijdCustomFieldId = civicrm_api3('CustomField', 'getvalue', array(
        'return' => "id",
        'name' => "einddatum_tijd",
      ));
    } catch (Exception $ex) {
      throw new Exception('Oops: Custom Field einddatum_tijd not found in configuration (File ' . __FILE__ . ' on line ' . __LINE__ . ')');
    }

  }

  /**
   * @return int
   */
  public function getEindDatumTijdCustomFieldId() {
    return $this->_eindDatumTijdCustomFieldId;
  }


  /**
   * Instantiates the singleton
   *
   * @return CRM_Wachtdienstimport_Config
   * @access public
   * @static
   */
  public static function singleton() {
    if (!self::$_singleton) {
      self::$_singleton = new CRM_Wachtdienstimport_Config();
    }
    return self::$_singleton;
  }

}