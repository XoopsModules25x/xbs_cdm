<?php declare(strict_types=1);

/**
 * Constant definitions that are language specific rather than module specific
 *
 * Definitions contained in this file conform to the Xoops standard for Language main.php file format
 *
 * @package       CDM
 * @subpackage    Definitions
 * @author        Ashley Kitson http://xoobs.net
 * @copyright (c) 2004 Ashley Kitson, Great Britain
 */

/**#@+
 * Language specific definitions
 */
define('_MD_XBSCDM_LISTTBL1NM', 'List of Code Sets');
define('_MD_XBSCDM_LISTTBL2NM', 'List of codes for Set: ');
define('_MD_XBSCDM_LISTCOlSET', 'Set');
define('_MD_XBSCDM_LISTCOlCODE', 'Code');
define('_MD_XBSCDM_LISTCOlPRNT', 'Parent');
define('_MD_XBSCDM_LISTCOlVAL', 'Value');
define('_MD_XBSCDM_LISTCOlDESC', 'Description');
define('_MD_XBSCDM_LISTCOlLANG', 'Lang');
define('_MD_XBSCDM_LISTCOLFLAG', 'Row Flag');
define('_MD_XBSCDM_LISTPAGETITLE', 'CDM - Codes List');
define('_MD_XBSCDM_CODESEDITPAGETITLE', 'CDM - Edit codes');
define('_MD_XBSCDM_CODESVIEWPAGETITLE', 'CDM - View codes');
define('_MD_XBSCDM_CODESEDITTABLE1', 'Click the browse button against the set of codes to display the associated codes');
define('_MD_XBSCDM_CODESEDITTABLE2', 'Click the edit button against the required code');
define('_MD_XBSCDM_LISTEDITNAME', 'Edit');
define('_MD_XBSCDM_LISTDISPLAYNAME', 'Display');
define('_MD_XBSCDM_LISTDELETENAME', 'Delete');
define('_MD_XBSCDM_LISTINSERTNAME', 'Insert record');
define('_MD_XBSCDM_LISTSETDESC', 'Code Set Description');
define('_MD_XBSCDM_EDITSELECTPAGETITLE', 'CDM - Select Code to Edit');
define('_MD_XBSCDM_CODEEDITFORMNAME', 'CDM - Edit a code');
define('_MD_XBSCDM_CODEEDITFORMCODENAME', 'Code Name');
define('_MD_XBSCDM_CODEEDITFORMCODEVALUE', 'Code Value');
define('_MD_XBSCDM_CODEEDITFORMLANG', 'Language Set');
define('_MD_XBSCDM_CODEEDITFORMSET', 'Code Set');
define('_MD_XBSCDM_CODEEDITFORMPARENT', 'Parent Code');
define('_MD_XBSCDM_CODEEDITFORMDESC', 'Code Description');
define('_MD_XBSCDM_SUBMITBUTTON', 'Submit');

// Strings used in cdm_meta_edit form
define('_MD_XBSCDM_MEF1', 'Set');
define('_MD_XBSCDM_MEF2', 'Code Type');
define('_MD_XBSCDM_MEF3', 'Code Length');
define('_MD_XBSCDM_MEF4', 'Value Type');
define('_MD_XBSCDM_MEF5', 'Value Length');
define('_MD_XBSCDM_MEF6', 'Set Description');
define('_MD_XBSCDM_MEF7', 'Record Status');
define('_MD_XBSCDM_MEF8', 'Last Record Editor');
define('_MD_XBSCDM_MEF9', 'Record Edit Time');
define('_MD_XBSCDM_MEF10', 'Save Changes');
define('_MD_XBSCDM_MEF11', 'Cancel Edit');
define('_MD_XBSCDM_MEF12', 'Reset Form');
define('_MD_XBSCDM_MEF13', 'Meta Code Data Record');
define('_MD_XBSCDM_MEF14', 'Record Edit Cancelled');
define('_MD_XBSCDM_MEF15', 'Record Updated');

//Strings used in cdm_codes_edit form
define('_MD_XBSCDM_CEF1', 'Code Name');
define('_MD_XBSCDM_CEF2', 'Set Name');
define('_MD_XBSCDM_CEF3', 'Code Language');
define('_MD_XBSCDM_CEF4', 'Parent Code');
define('_MD_XBSCDM_CEF5', 'Code Value');
define('_MD_XBSCDM_CEF6', 'Code Description');
define('_MD_XBSCDM_CEF7', 'Record Status');
define('_MD_XBSCDM_CEF8', 'Last Record Editor');
define('_MD_XBSCDM_CEF9', 'Record Edit Time');
define('_MD_XBSCDM_CEF10', 'Save Changes');
define('_MD_XBSCDM_CEF11', 'Cancel Edit');
define('_MD_XBSCDM_CEF12', 'Reset Form');
define('_MD_XBSCDM_CEF13', 'Code Data Record');
define('_MD_XBSCDM_CEF14', 'Record Edit Cancelled');
define('_MD_XBSCDM_CEF15', 'Record Updated');
define('_MD_XBSCDM_CEF16', 'Code Parameters<i> (Seperate each parameter with | )</i>');
define('_MD_XBSCDM_CEF17', 'Child Codes');

// Strings used in bulk update form
define('_MD_XBSCDM_UDF0', 'Update Codes Database');
define('_MD_XBSCDM_UDF1', 'Location of update SQL file');
define('_MD_XBSCDM_UDF2', 'Update Database');
define('_MD_XBSCDM_UDF3', 'Cancel Update');
define('_MD_XBSCDM_UDF4', 'Reset Form');

// Error string constants
define('_MD_XBSCDM_ERR_1', 'No data for CDMobject indexed by %s');
define('_MD_XBSCDM_ERR_2', 'Unable to instantiate CDMObject %s');
define('_MD_XBSCDM_ERR_3', 'Unable to reload. Given class is %s. Expected %s');
define('_MD_XBSCDM_ERR_4', 'Unable to reload CDMObject with null key');
define('_MD_XBSCDM_ERR_5', 'You must be logged in to edit records');
define('_MD_XBSCDM_ERR_6', 'is not a valid value for a code set name');

//SQL file update processing errors and messages
define('_MD_XBSCDM_ERR_20', 'SQL file not found at <b>%s</b>');
define('_MD_XBSCDM_ERR_21', 'SQL file found at <b>%s</b>.');
define('_MD_XBSCDM_ERR_22', '<b>%s</b> is not valid SQL syntax!');
define('_MD_XBSCDM_ERR_23', 'SQL command <b>%s</b> executed');
define('_MD_XBSCDM_ERR_24', '<b>%s</b> is a reserved table!');

/**#@-*/
