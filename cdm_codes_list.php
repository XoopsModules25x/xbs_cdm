<?php
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <https://xoops.org/>                             //
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
// URL:       http://xoobs.net                                               //
// Project:   The XOOPS Project (https://xoops.org/)                      //
// Module:    Code Data Management (CDM)                                     //
// ------------------------------------------------------------------------- //

/**
 * Displays the entire active code data set
 *
 * @author        Ashley Kitson http://xoobs.net
 * @copyright (c) 2004, Ashley Kitson
 * @version       1.2
 * @package       CDM
 * @subpackage    User_Interface
 * @access        private
 * @global xoopsDB     Interface to database object
 * @global xoopsTpl    Smarty template object
 * @global xoopsOption Smarty options array
 */
global $xoopsDB, $xoopsOption, $xoopsTpl;

/**
 * Require Statements
 */
require __DIR__ . '/header.php'; //MUST include page header
$GLOBALS['xoopsOption']['template_main'] = 'cdm_list_codes.tpl'; // Set the template page to be used
include XOOPS_ROOT_PATH . '/header.php'; // include the main header file

// Do some work! get the data from the database and get it ready for presentation
$sql = 'SELECT id, cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc FROM ' . $xoopsDB->prefix(CDM_TBL_CODE) . " WHERE row_flag = '" . CDM_RSTAT_ACT . "'";
$result = $xoopsDB->query($sql) or exit('Error reading database');

//set up page and column titles
$xoopsTpl->assign('lang_pagetitle', _MD_CDM_LISTPAGETITLE);
$xoopsTpl->assign('lang_col1name', _MD_CDM_LISTCOlSET);
$xoopsTpl->assign('lang_col2name', _MD_CDM_LISTCOlLANG);
$xoopsTpl->assign('lang_col3name', _MD_CDM_LISTCOlCODE);
$xoopsTpl->assign('lang_col4name', _MD_CDM_LISTCOlPRNT);
$xoopsTpl->assign('lang_col5name', _MD_CDM_LISTCOlVAL);
$xoopsTpl->assign('lang_col6name', _MD_CDM_LISTCOlDESC);
$xoopsTpl->assign('lang_edit', _MD_CDM_LISTEDITNAME);

//Take each row at a time from the result set and append it into the template
while ($myrow = $xoopsDB->fetchArray($result)) {
    $xoopsTpl->append('codes', $myrow);
}

include XOOPS_ROOT_PATH . '/footer.php'; //display the page!
