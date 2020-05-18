<?php declare(strict_types=1);

//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <https://www.xoops.org>                             //
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
// Copyright: (c) 2004, Ashley Kitson
// URL:       http://akitson.bbcb.co.uk                                      //
// Project:   The XOOPS Project (https://www.xoops.org/)                      //
// Module:    Code Data Management (CDM)                                     //
// ------------------------------------------------------------------------- //

/**
 * Display and edit a set of codes
 *
 * Allow use to select a set of codes for viewing and potential editing.
 * The page defaults to showing the 'BASE' set of codes.
 * This is the default page when starting the module
 *
 * @author        Ashley Kitson http://akitson.bbcb.co.uk
 * @copyright (c) 2004, Ashley Kitson
 * @package       CDM
 * @subpackage    User_Interface
 * @global xoopsTpl Smarty template object
 * @global xoopsOption Smarty options array
 */
global $xoopsTpl, $xoopsOption;
/**
 * MUST include module page header
 */
require('header.php');
$GLOBALS['xoopsOption']['template_main'] = 'cdm_index.tpl'; // Set the template page to be used

/**
 * include the main header file
 */
require XOOPS_ROOT_PATH . '/header.php';

// Page titles
$xoopsTpl->assign('lang_pagetitle', _MD_CDM_CODESEDITPAGETITLE);
$xoopsTpl->assign('lang_table1name', _MD_CDM_LISTTBL1NM);
$xoopsTpl->assign('lang_table2name', _MD_CDM_LISTTBL2NM);
$xoopsTpl->assign('lang_table1info', _MD_CDM_CODESEDITTABLE1);
$xoopsTpl->assign('lang_table2info', _MD_CDM_CODESEDITTABLE2);

//set up common table names
$xoopsTpl->assign('lang_select', _MD_CDM_LISTDISPLAYNAME);
$xoopsTpl->assign('lang_edit', _MD_CDM_LISTEDITNAME);
$xoopsTpl->assign('lang_delete', _MD_CDM_LISTDELETENAME);
$xoopsTpl->assign('lang_insert', _MD_CDM_LISTINSERTNAME);

//set up column titles for code sets
$xoopsTpl->assign('lang_tble1col1', _MD_CDM_LISTCOlSET);
$xoopsTpl->assign('lang_tble1col2', _MD_CDM_LISTSETDESC);
$xoopsTpl->assign('lang_tble1col3', _MD_CDM_LISTCOLFLAG);

//set up page and column titles for list of codes
$lang_tble2nm = [_MD_CDM_LISTCOlSET, _MD_CDM_LISTCOlLANG, _MD_CDM_LISTCOlCODE, _MD_CDM_LISTCOlVAL, _MD_CDM_LISTCOlDESC, _MD_CDM_LISTCOlPRNT, _MD_CDM_LISTCOLFLAG];
$xoopsTpl->assign('lang_tble2nm', $lang_tble2nm);

//get Meta data to display
$metaHandler = xoops_getModuleHandler('CDMMeta', CDM_DIR);
$metaData    = $metaHandler->listMeta();
//append it into the template, and find the first set name at same time
$count = 0;
foreach ($metaData as $myrow) {
    $xoopsTpl->append('sets', $myrow);

    if (0 == $count) {
        $codeSet = $myrow['cd_set'];

        $count++;
    }
}

//  Check to see if the page has been called with another code set
$codeSet = (empty($_GET['codeSet']) ? $codeSet : $_GET['codeSet']);
$xoopsTpl->assign('setname', $codeSet);
// get code data for display
$setHandler = xoops_getModuleHandler('CDMSet', CDM_DIR);
$set        = &$setHandler->getall($codeSet);
if ($set) {
    $codeData = $set->getFullCodeList();

    //append it to template

    foreach ($codeData as $myrow) {
        $xoopsTpl->append('codes', $myrow);
    }  //if $set is not valid it means there are no codes for the set
}//end if

require XOOPS_ROOT_PATH . '/footer.php';        //display the page!
