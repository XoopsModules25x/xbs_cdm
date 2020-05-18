<?php declare(strict_types=1);

//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <https://xoops.org>                             //
//  ------------------------------------------------------------------------ //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //
// Author:    Ashley Kitson                                                  //
// Copyright: (c) 2005, Ashley Kitson
// URL:       http://xoobs.net                                               //
// Project:   The XOOPS Project (https://xoops.org/)                      //
// Module:    Code Data Management (CDM)                                     //
// ------------------------------------------------------------------------- //
/**
 * Admin page header
 *
 * Does all the includes and any declarations needed to display an administration
 * page.  This could all be put at the top of each page, but it is marginally
 * simpler to write it once
 *
 * @author     Ashley Kitson http://xoobs.net
 * @package    CDM
 * @subpackage Admin
 * @version    1
 * @access     private
 */

/**
 * The control panel header script that:
 *
 * - includes Xoops mainfile.php
 * - includes cp_functions.php (control panel functions declarations)
 * - checks access rights to the page and denies if no right
 * - sets up var $xoopsModule object to point to current module
 * - sets up var $xoopsModuleConfig object to hold current module configuration parameters
 * - loads up the default language file for admin interface
 */
require_once dirname(dirname(dirname(__DIR__))) . '/include/cp_header.php';

/**
 * @global object Xoops user object
 * @global object Xoops main configuration object
 * @global object This module's configuration object
 * @global object This module
 * @global object Xoops database object
 */
global $xoopsUser, $xoopsConfig, $xoopsModuleConfig, $xoopsModule;
global $xoopsDB;

/**
 * Function: Creates a pretty menu and navigation bar above your module admin page
 *
 * I've nicked the basis of this from functions.php,v 1.2 of the new Profiles module
 * developed by hyperpod for Xoops V1.2
 *
 * @param int    $currentoption The menu option to display as being current
 * @param string $breadcrumb    the trail back to where we've come from
 * @version 1
 * @author  hyperpod (parts) A Kitson (parts)
 *
 */
function xoops_module_admin_menu($currentoption = 0, $breadcrumb = '')
{
    /**
     * @global object This module object
     * @global object Xoops config parameter object
     */

    global $xoopsModule, $xoopsConfig;

    $configStr = '';

    /** @var string module directory name */

    $modDir = $xoopsModule->getVar('dirname');

    /** @var string Set the path to the admin images directory */

    $imagePath = XOOPS_URL . '/modules/' . $modDir . '/admin/images/'; //<V2.1 version

    //$imagePath = XOOPS_URL."/images/admin/";  //V2.1 version

    /**
     * Load up the module installation constants so that when menu.php is included, the menu strings are set correctly
     */

    $modDir = $xoopsModule->getVar('dirname');

    if (file_exists(XOOPS_ROOT_PATH . '/modules/' . $modDir . '/language/' . $xoopsConfig['language'] . '/modinfo.php')) {
        require_once XOOPS_ROOT_PATH . '/modules/' . $modDir . '/language/' . $xoopsConfig['language'] . '/modinfo.php';
    } else {
        require_once XOOPS_ROOT_PATH . '/modules/' . $modDir . '/english/modinfo.php';
    }

    //include the default xoops language file for the admin interface

    //NOT required in this file for V2.1

    if (file_exists(XOOPS_ROOT_PATH . '/modules/' . $modDir . '/language/' . $xoopsConfig['language'] . '/admin2.php')) {
        require XOOPS_ROOT_PATH . '/modules/' . $modDir . '/language/' . $xoopsConfig['language'] . '/admin2.php';
    } elseif (file_exists(XOOPS_ROOT_PATH . '/modules/' . $modDir . '/language/english/admin.php2')) {
        require XOOPS_ROOT_PATH . '/modules/' . $modDir . '/language/english/admin2.php';
    }

    /**
     * Set up menu option display array
     */

    require_once XOOPS_ROOT_PATH . '/modules/' . $modDir . '/admin/menu.php';

    //extend the menu option array to hold colour information

    // and strip out the /admin/ part of the link name

    $dispMenu = [];

    $c = 1;

    foreach ($adminmenu as $option) {
        $dispMenu[$c]['tblColour'] = '';

        $arr = explode('/', $option['link']);

        $dispMenu[$c]['link'] = $arr[count($arr) - 1];

        $dispMenu[$c]['title'] = $option['title'];

        $c++;
    }

    //set the current option colour

    if ($currentoption > 0) {
        $dispMenu[$currentoption]['tblColour'] = 'current';
    }

    //upper case the module directory

    $mdir = mb_strtoupper($modDir);

    //set up vars from constant definitions

    /** @var bool has the module got documentation */

    $hasDocs = defined('_AM_' . $mdir . '_URL_DOCS');

    /** @var bool has the module got support */

    $hasSupport = defined('_AM_' . $mdir . '_URL_SUPPORT');

    /** @var bool Has the module got donations facility */

    $hasDonations = defined('_AM_' . $mdir . '_URL_DONATIONS');

    if ($hasDocs) {
        /** @var string Url of documentation */

        $urlDocs = XOOPS_URL . '/modules/' . $modDir . '/' . constant('_AM_' . $mdir . '_URL_DOCS');
    }

    if ($hasSupport) {
        /** @var string Url of support site */

        $urlSupport = constant('_AM_' . $mdir . '_URL_SUPPORT');
    }

    if ($hasDonations) {
        /** @var string Url of donations facility */

        $urlDonations = constant('_AM_' . $mdir . '_URL_DONATIONS');
    }

    if (defined('_AM_' . $mdir . '_MODCONFIG')) {
        /** @var string module config option */

        $configType = constant('_AM_' . $mdir . '_MODCONFIG');

        /** @var bool does the module have any configuration */

        $hasConfig = ('none' != $configType);

        if ('module' == $configType) {
            /** @var string name of callback function for module configuration */

            $modConfigUrl = constant('_AM_' . $mdir . '_MODCONFIGURL');
        }
    } else {
        $hasConfig = false;
    }

    // Display the page header - don't ask me how this works I don't do CSS ! (AK)

    /* Nice buttons styles */

    echo "
        <style type='text/css'>
        #buttontop { float:left; width:100%; background: #e7e7e7; font-size:93%; line-height:normal; border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black; margin: 0; }
        #buttonbar { float:left; width:100%; background: #e7e7e7 url('" . $imagePath . "bg.gif') repeat-x left bottom; font-size:93%; line-height:normal; border-left: 1px solid black; border-right: 1px solid black; margin-bottom: 12px; }
        #buttonbar ul { margin:0; margin-top: 15px; padding:10px 10px 0; list-style:none; }
        #buttonbar li { display:inline; margin:0; padding:0; }
        #buttonbar a { float:left; background:url('" . $imagePath . "left_both.gif') no-repeat left top; margin:0; padding:0 0 0 9px; border-bottom:1px solid #000; text-decoration:none; }
        #buttonbar a span { float:left; display:block; background:url('" . $imagePath . "right_both.gif') no-repeat right top; padding:5px 15px 4px 6px; font-weight:bold; color:#765; }
        /* Commented Backslash Hack hides rule from IE5-Mac \*/
        #buttonbar a span {float:none;}
        /* End IE5-Mac hack */
        #buttonbar a:hover span { color:#333; }
        #buttonbar #current a { background-position:0 -150px; border-width:0; }
        #buttonbar #current a span { background-position:100% -150px; padding-bottom:5px; color:#333; }
        #buttonbar a:hover { background-position:0% -150px; }
        #buttonbar a:hover span { background-position:100% -150px; }
        </style>
    ";

    $myts = MyTextSanitizer::getInstance();

    echo "<div id='buttontop'>";

    echo '<table style="width: 100%; padding: 0; " cellspacing="0"><tr>';

    echo '<td style="width: 70%; font-size: 10px; text-align: left; color: #2F5376; padding: 0 6px; line-height: 18px;">';

    if ($hasConfig) {
        $configStr = '<a class="nobutton" href=';

        if ('xoops' == $configType) {
            $configStr .= '"../../system/admin.php?fct=preferences&amp;op=showmod&amp;mod=' . $xoopsModule->getVar('mid') . '">';
        } else {
            $configStr .= '"' . $modConfigUrl . '">';
        }

        $configStr .= _AD_MOD_CONFIG . '</a> | ';
    }

    echo $configStr;

    echo '<a href="../index.php">' . _AD_MOD_HOME . '</a>';

    if ($hasDocs) {
        echo ' | <a target="_blank" href="' . $urlDocs . '">' . _AD_DOCS . '</a>';
    }

    if ($hasSupport) {
        echo ' | <a target="_blank" href="' . $urlSupport . '">' . _AD_SUPPORT . '</a>';
    }

    if ($hasDonations) {
        echo ' | <a target="_blank" href="' . $urlDonations . '">' . _AD_DONATIONS . '</a>';
    }

    echo '</td>';

    echo '<td style="width: 30%; font-size: 10px; text-align: right; color: #2F5376; padding: 0 6px; line-height: 18px;"><b>' . $myts->displayTarea($xoopsModule->getVar('name')) . ' ' . _AD_MODADMIN . '</b> ' . $breadcrumb . '</td>';

    echo '</tr></table>';

    echo '</div>';

    echo "<div id='buttonbar'>";

    echo '<ul>';

    foreach ($dispMenu as $option) {
        echo "<li id='" . $option['tblColour'] . "'><a href='" . $option['link'] . "'><span>" . $option['title'] . '</span></a></li>';
    }

    echo '</ul></div><p>';

    echo '<br><br><pre>&nbsp;</pre><pre>&nbsp;</pre>';
}

/**
 * Put below any other includes you need for your admin pages to work.
 * These might include some specialised functions or class declarations
 */

/**
 * Load up the module language constants
 */
$modDir = $xoopsModule->getVar('dirname');
if (file_exists(XOOPS_ROOT_PATH . '/modules/' . $modDir . '/language/' . $xoopsConfig['language'] . '/main.php')) {
    require_once XOOPS_ROOT_PATH . '/modules/' . $modDir . '/language/' . $xoopsConfig['language'] . '/main.php';
} else {
    require_once XOOPS_ROOT_PATH . '/modules/' . $modDir . '/english/main.php';
}

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
