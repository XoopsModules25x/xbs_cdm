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
 * Displays the entire active code data set
 *
 * @copyright (c) 2004, Ashley Kitson
 * @copyright     XOOPS Project https://xoops.org/
 * @license       GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @author        Ashley Kitson http://akitson.bbcb.co.uk
 * @author        XOOPS Development Team
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

$GLOBALS['xoopsOption']['template_main'] = 'xbscdm_list_codes.tpl'; // Set the template page to be used
require __DIR__ . '/header.php'; //MUST include page header
require XOOPS_ROOT_PATH . '/header.php'; // include the main header file

// Do some work! get the data from the database and get it ready for presentation
$sql = 'SELECT id, cd_set, cd_lang, cd, cd_prnt, cd_value, cd_desc FROM ' . $xoopsDB->prefix(CDM_TBL_CODE) . " WHERE row_flag = '" . CDM_RSTAT_ACT . "'";
$result = $xoopsDB->query($sql) or exit('Error reading database');

//set up page and column titles
$xoopsTpl->assign('lang_pagetitle', _MD_XBSCDM_LISTPAGETITLE);
$xoopsTpl->assign('lang_col1name', _MD_XBSCDM_LISTCOlSET);
$xoopsTpl->assign('lang_col2name', _MD_XBSCDM_LISTCOlLANG);
$xoopsTpl->assign('lang_col3name', _MD_XBSCDM_LISTCOlCODE);
$xoopsTpl->assign('lang_col4name', _MD_XBSCDM_LISTCOlPRNT);
$xoopsTpl->assign('lang_col5name', _MD_XBSCDM_LISTCOlVAL);
$xoopsTpl->assign('lang_col6name', _MD_XBSCDM_LISTCOlDESC);
$xoopsTpl->assign('lang_edit', _MD_XBSCDM_LISTEDITNAME);

//Take each row at a time from the result set and append it into the template
while (false !== ($myrow = $xoopsDB->fetchArray($result))) {
    $xoopsTpl->append('codes', $myrow);
}

require XOOPS_ROOT_PATH . '/footer.php'; //display the page!
