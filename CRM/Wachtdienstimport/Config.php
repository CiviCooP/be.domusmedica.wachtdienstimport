<?php
/**
 * Created by PhpStorm.
 * User: klaas
 * Date: 6-4-18
 * Time: 10:41
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