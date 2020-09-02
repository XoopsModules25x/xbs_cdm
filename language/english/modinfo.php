<?php declare(strict_types=1);

// $Id: modinfo.php,v 1.14 2004/09/11 10:37:03 onokazu Exp $
// Module Info

/**
 * Constant definitions that are module specific.
 *
 * Definitions in this file conform to the Xoops standard for the modinfo.php file
 *
 * @package       CDM
 * @subpackage    Definitions
 * @version       1.5
 * @access        private
 * @copyright (c) 2004, Ashley Kitson
 * @copyright     XOOPS Project https://xoops.org/
 * @license       GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @author        Ashley Kitson http://akitson.bbcb.co.uk
 * @author        XOOPS Development Team
 */

/**
 * The name of this module
 */
define('_MI_XBSCDM_NAME', 'XBS Code Data Management');

/**
 *  A brief description of this module
 */
define('_MI_XBSCDM_DESC', 'Provides a central repository for codes to be used by other applications. Install the module and see API/help documentation in cdmhelp.html for usage. Code sets for Language, ISO Country and ISO Currency are installed by default.');

/**
 *  Sub menu titles
 */
define('_MI_XBSCDM_SMNAME1', 'Simple List of Codes');

/**#@+
 * Admin menu title
 */
define('_MI_XBSCDM_HOME', 'Home');
define('_MI_XBSCDM_ABOUT', 'About');
define('_MI_XBSCDM_ADMENU1', 'Code Sets');
define('_MI_XBSCDM_ADMENU2', 'Codes');
define('_MI_XBSCDM_ADMENU3', 'Bulk Upload');
define('_MI_XBSCDM_ADMENU4', 'Docu');

/**#@-*/

/**#@+
 * Configuration item names and descriptions
 */
define('_MI_XBSCDM_DEFLANGNAME', 'Default Language');
define('_MI_XBSCDM_DEFLANGNAMEDESC', 'The default language set for codes');
define('_MI_XBSCDM_DEFCODESETNAME', 'Default Code Set');
define('_MI_XBSCDM_DEFCODESETNAMEDESC', 'The default codeset to add codes to or display');
/**#@-*/

/**#@+
 * Block naming and descriptions
 */
define('_MI_XBSCDM_BLOCK_CODELOOKUPNAME', 'Code Lookup');
define('_MI_XBSCDM_BLOCK_CODELOOKUPDESC', 'Displays code values and descriptions for a code set');
/**#@-*/

//Help
define('_MI_XBSCDM_DIRNAME', basename(dirname(__DIR__, 2)));
define('_MI_XBSCDM_HELP_HEADER', __DIR__ . '/help/helpheader.tpl');
define('_MI_XBSCDM_BACK_2_ADMIN', 'Back to Administration of ');
define('_MI_XBSCDM_OVERVIEW', 'Overview');

//define('_MI_XBSCDM_HELP_DIR', __DIR__);

//help multi-page
define('_MI_XBSCDM_DISCLAIMER', 'Disclaimer');
define('_MI_XBSCDM_LICENSE', 'License');
define('_MI_XBSCDM_SUPPORT', 'Support');
