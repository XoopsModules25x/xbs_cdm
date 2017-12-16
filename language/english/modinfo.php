<?php
// $Id: modinfo.php,v 1.14 2004/09/11 10:37:03 onokazu Exp $
// Module Info

/**
 * Constant definitions that are module specific.
 * 
 * Definitions in this file conform to the Xoops standard for the modinfo.php file
 *
 * @package CDM
 * @subpackage Definitions
 * @version 1.5
 * @access private
 * @author Ashley Kitson http://xoobs.net
 * @copyright (c) 2004 Ashley Kitson, Great Britain
*/

/**
 * The name of this module
 */
define("_MI_CDM_NAME","Code Data Management");

/**
 *  A brief description of this module
 */
define("_MI_CDM_DESC","Provides a central repository for codes to be used by other applications. Install the module and see API/help documentation in cdmhelp.html for usage. Code sets for Language, ISO Country and ISO Currency are installed by default.");

/**
 *  Sub menu titles
 */
define("_MI_CDM_SMNAME1","Simple List of Codes");

/**#@+
 * Admin menu title
 */
define("_MI_CDM_ADMENU1","Code Sets");
define("_MI_CDM_ADMENU2","Codes");
define("_MI_CDM_ADMENU3","Bulk Upload");
/**#@-*/

/**#@+
 * Configuration item names and descriptions
 */
define("_MI_CDM_DEFLANGNAME","Default Language");
define("_MI_CDM_DEFLANGNAMEDESC","The default language set for codes");
define("_MI_CDM_DEFCODESETNAME","Default Code Set");
define("_MI_CDM_DEFCODESETNAMEDESC","The default codeset to add codes to or display");
/**#@-*/

/**#@+
 * Block naming and descriptions
 */
define("_MI_CDM_BLOCK_CODELOOKUPNAME","Code Lookup");
define("_MI_CDM_BLOCK_CODELOOKUPDESC","Displays code values and descriptions for a code set");
/**#@-*/
?>
