<?php

require_once 'wachtdienstimport.civix.php';
use CRM_Wachtdienstimport_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function wachtdienstimport_civicrm_config(&$config) {
  _wachtdienstimport_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function wachtdienstimport_civicrm_xmlMenu(&$files) {
  _wachtdienstimport_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function wachtdienstimport_civicrm_install() {
  _wachtdienstimport_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function wachtdienstimport_civicrm_postInstall() {
  _wachtdienstimport_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function wachtdienstimport_civicrm_uninstall() {
  _wachtdienstimport_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function wachtdienstimport_civicrm_enable() {
  _wachtdienstimport_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function wachtdienstimport_civicrm_disable() {
  _wachtdienstimport_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function wachtdienstimport_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _wachtdienstimport_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function wachtdienstimport_civicrm_managed(&$entities) {
  _wachtdienstimport_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function wachtdienstimport_civicrm_caseTypes(&$caseTypes) {
  _wachtdienstimport_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_angularModules
 */
function wachtdienstimport_civicrm_angularModules(&$angularModules) {
  _wachtdienstimport_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function wachtdienstimport_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _wachtdienstimport_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
function wachtdienstimport_civicrm_preProcess($formName, &$form) {

} // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 **/
function wachtdienstimport_civicrm_navigationMenu(&$menu) {
  _wachtdienstimport_civix_insert_navigation_menu($menu, 'kringen', array(
    'label' => E::ts('Wachtdienst Import'),
    'name' => 'wachtdienstupload',
    'url' => 'civicrm/wachtdienstimport/upload',
    'permission' => 'access CiviReport,access CiviContribute',
    'operator' => 'OR',
    'separator' => 0,
  ));
  _wachtdienstimport_civix_insert_navigation_menu($menu, 'kringen', array(
    'label' => E::ts('Wachtdienst uitvallijst'),
    'name' => 'wachtdienstuploadresult',
    'url' => 'civicrm/wachtdienstimport/uploadresult',
    'permission' => 'access CiviReport,access CiviContribute',
    'operator' => 'OR',
    'separator' => 0,
  ));
  _wachtdienstimport_civix_navigationMenu($menu);
}
