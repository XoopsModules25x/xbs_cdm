<?php declare(strict_types=1);

/**
 * Module header file required by xoops
 *
 * Every CDM file will include this header file.
 *
 * @copyright (c) 2004, Ashley Kitson
 * @copyright     XOOPS Project https://xoops.org/
 * @license       GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @author        Ashley Kitson http://akitson.bbcb.co.uk
 * @author        XOOPS Development Team
 * @package       CDM
 * @subpackage    Xoops
 * @access        private
 */

use XoopsModules\Xbscdm\{Helper
};

/**
 * Xoops required include
 */
require dirname(__DIR__, 2) . '/mainfile.php';

require __DIR__ . '/preloads/autoloader.php';

/**
 * If you want to use CDM in your own application, you must include defines.php in your own module header file
 */
require XOOPS_ROOT_PATH . '/modules/xbscdm/include/defines.php';

$moduleDirName = basename(__DIR__);

/** @var Helper $helper */
$helper = Helper::getInstance();

$myts = \MyTextSanitizer::getInstance();

if (!isset($GLOBALS['xoTheme']) || !is_object($GLOBALS['xoTheme'])) {
    require $GLOBALS['xoops']->path('class/theme.php');
    $GLOBALS['xoTheme'] = new \xos_opal_Theme();
}

// Load language files
$helper->loadLanguage('main');

if (!isset($GLOBALS['xoopsTpl']) || !($GLOBALS['xoopsTpl'] instanceof XoopsTpl)) {
    require $GLOBALS['xoops']->path('class/template.php');
    $xoopsTpl = new XoopsTpl();
}
