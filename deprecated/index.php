<?php declare(strict_types=1);

use XoopsModules\Xbscdm\Helper;

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
 * Display and edit a set of codes
 *
 * Allow use to select a set of codes for viewing and potential editing.
 * The page defaults to showing the 'BASE' set of codes.
 * This is the default page when starting the module
 *
 * @copyright (c) 2004, Ashley Kitson
 * @copyright     XOOPS Project https://xoops.org/
 * @license       GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @author        Ashley Kitson http://akitson.bbcb.co.uk
 * @author        XOOPS Development Team
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
$GLOBALS['xoopsOption']['template_main'] = 'xbscdm_index.tpl'; // Set the template page to be used

/**
 * include the main header file
 */
require XOOPS_ROOT_PATH . '/header.php';

// Page titles
$xoopsTpl->assign('lang_pagetitle', _MD_XBSCDM_CODESEDITPAGETITLE);
$xoopsTpl->assign('lang_table1name', _MD_XBSCDM_LISTTBL1NM);
$xoopsTpl->assign('lang_table2name', _MD_XBSCDM_LISTTBL2NM);
$xoopsTpl->assign('lang_table1info', _MD_XBSCDM_CODESEDITTABLE1);
$xoopsTpl->assign('lang_table2info', _MD_XBSCDM_CODESEDITTABLE2);

//set up common table names
$xoopsTpl->assign('lang_select', _MD_XBSCDM_LISTDISPLAYNAME);
$xoopsTpl->assign('lang_edit', _MD_XBSCDM_LISTEDITNAME);
$xoopsTpl->assign('lang_delete', _MD_XBSCDM_LISTDELETENAME);
$xoopsTpl->assign('lang_insert', _MD_XBSCDM_LISTINSERTNAME);

//set up column titles for code sets
$xoopsTpl->assign('lang_tble1col1', _MD_XBSCDM_LISTCOlSET);
$xoopsTpl->assign('lang_tble1col2', _MD_XBSCDM_LISTSETDESC);
$xoopsTpl->assign('lang_tble1col3', _MD_XBSCDM_LISTCOLFLAG);

//set up page and column titles for list of codes
$lang_tble2nm = [_MD_XBSCDM_LISTCOlSET, _MD_XBSCDM_LISTCOlLANG, _MD_XBSCDM_LISTCOlCODE, _MD_XBSCDM_LISTCOlVAL, _MD_XBSCDM_LISTCOlDESC, _MD_XBSCDM_LISTCOlPRNT, _MD_XBSCDM_LISTCOLFLAG];
$xoopsTpl->assign('lang_tble2nm', $lang_tble2nm);

//get Meta data to display
$metaHandler = Helper::getInstance()->getHandler('Meta');
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
$setHandler = Helper::getInstance()->getHandler('Set');
$set        = $setHandler->getAll($codeSet);
if ($set) {
    $codeData = $set->getFullCodeList();

    //append it to template

    foreach ($codeData as $myrow) {
        $xoopsTpl->append('codes', $myrow);
    }  //if $set is not valid it means there are no codes for the set
}//end if

require XOOPS_ROOT_PATH . '/footer.php';        //display the page!
