<?php declare(strict_types=1);

//%%%%%%        Module Name 'CDM'       %%%%%
/**
 * Module administration language constant definitions
 *
 * This is the language specific file for UK English language
 *
 * @copyright (c) 2004, Ashley Kitson
 * @copyright     XOOPS Project https://xoops.org/
 * @license       GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @author        Ashley Kitson http://akitson.bbcb.co.uk
 * @author        XOOPS Development Team
 * @package       CDM
 * @subpackage    Definitions
 * @version       1
 * @access        private
 */

/**#@+
 * Constants for Admin menu - non language specific
 */

/**
 * Admin menu parameters
 *
 * These MUST follow the format _AM_<ModDir>_URL_DOCS etc
 * so that the xoops_module_admin_header functions can work.
 * The suffix after <modDir> is not optional!
 * Leave them commented out if you do not have the functionality for your module
 *
 * Relative url from module directory for documentation
 */
define('_AM_XBS_XBSCDM_URL_DOCS', 'admin/help.php');
/**
 * Absolute url for module support site
 */
define('_AM_XBS_XBSCDM_URL_SUPPORT', 'http://www.xoobs.net/modules/newbb/viewforum.php?forum=2');
/**
 * absolute url for module donations site
 */
//define("_AM_XBS_XBSCDM_URL_DONATIONS","");

/**
 * Module configuration option - MUST follow the format _AM_<ModDir>_MODCONFIG
 * Value MUST be "xoops", "module" or "none"
 */
define('_AM_XBS_XBSCDM_MODCONFIG', 'xoops');

/**
 * If module configuration option = "module" then define the name of the script
 * to call for module configuration.  This relative to modDir/admin/
 * MUST follow the format _AM_<ModDir>_MODCONFIGURL
 * e.g. define("_AM_XBS_XBSCDM_MODCONFIGURL","CDMConfig.php");
 * and define a message that is shown to users prior to redirecting to the config page
 * e.g. define("_AM_XBS_XBSCDM_MODCONFIGREDIRECT","Configuration is done via the CDM system. You will shortly be redirected there.")
 */
/**#@-*/

/**#@+
 * Constants for Admin menu - Language specific
 */

// Admin menu breadcrumb
define('_AM_XBSCDM_ADMENU1', 'Code Sets');
define('_AM_XBSCDM_ADMENU2', 'Codes');
define('_AM_XBSCDM_ADMENU3', 'Bulk Upload');

//Code Sets - Choose a code set to work with
define('_AM_XBSCDM_SELSET', 'Choose a Code Set to work with');
define('_AM_XBSCDM_SELLANG', 'Choose a language set');
define('_AM_XBSCDM_SETFORM', 'Code Set');

//Code Sets - Edit a code set
define('_AM_XBSCDM_SETED0', 'CDM - Edit a Code Set');
define('_AM_XBSCDM_SETED1', 'Set Name');
define('_AM_XBSCDM_SETED2', 'Code Data Type');
define('_AM_XBSCDM_SETED3', 'Code Data Length');
define('_AM_XBSCDM_SETED4', 'Code Value Type');
define('_AM_XBSCDM_SETED5', 'Code Value Length');
define('_AM_XBSCDM_SETED6', 'Set Description');
define('_AM_XBSCDM_SETED100', 'Code Set details changed');
define('_AM_XBSCDM_SETED101', 'Code Set edit cancelled');

//Codes - choose a code
define('_AM_XBSCDM_SELCODE', 'Choose a code to work with');
define('_AM_XBSCDM_CODEFORM', 'Code Selection');

//Codes - edit an account
define('_AM_XBSCDM_CODED0', 'CDM - Edit an Account');
define('_AM_XBSCDM_CODED1', 'Set Name');
define('_AM_XBSCDM_CODED2', 'Code Language');
define('_AM_XBSCDM_CODED3', 'Code');
define('_AM_XBSCDM_CODED4', 'Parent Code (Optional)');
define('_AM_XBSCDM_CODED5', 'Value');
define('_AM_XBSCDM_CODED6', 'Description');
define('_AM_XBSCDM_CODED7', 'Parameters (Optional - Use | to seperate)');
define('_AM_XBSCDM_CODED100', 'Code details changed');
define('_AM_XBSCDM_CODED101', 'Code edit cancelled');

//buttons
define('_AM_XBSCDM_INSERT', 'Insert');
define('_AM_XBSCDM_BROWSE', 'Browse');
define('_AM_XBSCDM_SUBMIT', 'Submit');
define('_AM_XBSCDM_CANCEL', 'Cancel');
define('_AM_XBSCDM_RESET', 'Reset');
define('_AM_XBSCDM_EDIT', 'Edit');
define('_AM_XBSCDM_GO', 'Go');

//button labels
define('_AM_XBSCDM_INSERT_DESC', 'Create a new record');

//Common row status descriptions
define('_AM_XBSCDM_RSTATNM', 'Row Status');
define('_AM_XBSCDM_RUIDNM', 'Last edited by');
define('_AM_XBSCDM_RDTNM', 'Last edit datetime');

/**#@-*/

define('_AM_XBSCDM_UPGRADEFAILED0', "Update failed - couldn't rename field '%s'");
define('_AM_XBSCDM_UPGRADEFAILED1', "Update failed - couldn't add new fields");
define('_AM_XBSCDM_UPGRADEFAILED2', "Update failed - couldn't rename table '%s'");
define('_AM_XBSCDM_ERROR_COLUMN', 'Could not create column in database : %s');
define('_AM_XBSCDM_ERROR_BAD_XOOPS', 'This module requires XOOPS %s+ (%s installed)');
define('_AM_XBSCDM_ERROR_BAD_PHP', 'This module requires PHP version %s+ (%s installed)');
define('_AM_XBSCDM_ERROR_TAG_REMOVAL', 'Could not remove tags from Tag Module');

define('_AM_XBSCDM_FOLDERS_DELETED_OK', 'Upload Folders have been deleted');

// Error Msgs
define('_AM_XBSCDM_ERROR_BAD_DEL_PATH', 'Could not delete %s directory');
define('_AM_XBSCDM_ERROR_BAD_REMOVE', 'Could not delete %s');
define('_AM_XBSCDM_ERROR_NO_PLUGIN', 'Could not load plugin');
