<?php declare(strict_types=1);

/*
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * @copyright    The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license      GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package
 * @since
 * @author       XOOPS Development Team
 */
include dirname(__DIR__) . '/preloads/autoloader.php';

require  dirname(dirname(dirname(__DIR__))) . '/include/cp_header.php';
require $GLOBALS['xoops']->path('www/class/xoopsformloader.php');
require  dirname(__DIR__) . '/include/common.php';

$moduleDirName = basename(dirname(__DIR__));

/** @var \XoopsModules\Xbscdm\Helper $helper */
$helper = \XoopsModules\Xbscdm\Helper::getInstance();

/** @var \Xmf\Module\Admin $adminObject */
$adminObject = \Xmf\Module\Admin::getInstance();

// Load language files
$helper->loadLanguage('admin');
$helper->loadLanguage('modinfo');
$helper->loadLanguage('common');
$helper->loadLanguage('main');


/**
 * Include CDM constant defines
 */
require_once dirname(__DIR__) . '/include/defines.php';

/**
 * CDM functions
 */
require_once CDM_PATH . '/include/functions.php';
/**
 * include the module admin special functions
 */
require_once __DIR__ . '/functions.php';

/**
 * Call the admin page header function
 */
xoops_cp_header();

