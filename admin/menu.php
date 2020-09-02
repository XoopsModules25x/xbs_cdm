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
 * Admin menu declaration
 *
 * This script conforms to the Xoops standard for admin/menu.php
 *
 * @copyright (c) 2004, Ashley Kitson
 * @copyright     XOOPS Project https://xoops.org/
 * @license       GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @author        Ashley Kitson http://akitson.bbcb.co.uk
 * @author        XOOPS Development Team
 * @package       CDM
 * @subpackage    Admin
 * @version       1
 * @access        private
 */

/**
 * Whilst you can link your menu options to a single file, typically admin/index.php
 * and use a switch statement on a variable passed to it from here, to keep things
 * simple, use one script per menu option;
 */

use Xmf\Module\Admin;
use XoopsModules\Xbscdm\Helper;

include dirname(__DIR__) . '/preloads/autoloader.php';

$moduleDirName      = basename(dirname(__DIR__));
$moduleDirNameUpper = mb_strtoupper($moduleDirName);
/** @var \XoopsModules\Xbscdm\Helper $helper */
$helper = Helper::getInstance();
$helper->loadLanguage('common');
$helper->loadLanguage('feedback');

$pathIcon32 = Admin::menuIconPath('');
if (is_object($helper->getModule())) {
    $pathModIcon32 = $helper->url($helper->getModule()->getInfo('modicons32'));
}

$adminmenu              = [];
$i                      = 0;
$adminmenu[$i]['title'] = _MI_XBSCDM_HOME;
$adminmenu[$i]['link']  = 'admin/index.php';
$adminmenu[$i]['icon']  = $pathIcon32 . '/home.png';
//$i++;
//$adminmenu[$i]['title'] = _MI_OLEDRION_ADMENU10;
//$adminmenu[$i]['link'] = "admin/main.php";
//$adminmenu[$i]["icon"]  = $pathIcon32 . '/manage.png';
$i++;
$adminmenu[$i]['title'] = _MI_XBSCDM_ADMENU1;
$adminmenu[$i]['link']  = 'admin/adminsets.php';
$adminmenu[$i]['icon']  = $pathIcon32 . '/type.png';
$i++;
$adminmenu[$i]['title'] = _MI_XBSCDM_ADMENU2;
$adminmenu[$i]['link']  = 'admin/admincodes.php';
$adminmenu[$i]['icon']  = $pathIcon32 . '/manage.png';
$i++;
$adminmenu[$i]['title'] = _MI_XBSCDM_ADMENU3;
$adminmenu[$i]['link']  = 'admin/adminupload.php';
$adminmenu[$i]['icon']  = $pathIcon32 . '/upload.png';
$i++;
$adminmenu[$i]['title'] = _MI_XBSCDM_ABOUT;
$adminmenu[$i]['link']  = 'admin/about.php';
$adminmenu[$i]['icon']  = $pathIcon32 . '/about.png';
$i++;
$adminmenu[$i]['title'] = _MI_XBSCDM_ADMENU4;
$adminmenu[$i]['link']  = 'admin/help.php';
$adminmenu[$i]['icon']  = $pathIcon32 . '/help.png';
