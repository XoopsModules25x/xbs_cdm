<?php declare(strict_types=1);

use XoopsModules\Xbscdm\Utility;

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
 * Bulk update the codes database
 *
 * Allows user to apply a SQL updating script to the database.
 * Normally this will allow the bulk addition of new code sets but it can be
 * used in xoops installations prior to 2.2 to run CDM module update scripts
 * that may change CDM table structures etc.
 * This version used prior to introduction of admin functions for CDM
 *
 * @copyright (c) 2004, Ashley Kitson
 * @copyright     XOOPS Project https://xoops.org/
 * @license       GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @author        Ashley Kitson http://akitson.bbcb.co.uk
 * @author        XOOPS Development Team
 * @package       CDM
 * @subpackage    Update
 * @version       1.4
 * @access        private
 * @global xoopsDB Interface to database object
 * @global xoopsTpl Smarty template object
 * @global xoopsOption Smarty options array
 * @global array Form POST variable array
 * @global array Form GET variable array
 */

global $xoopsDB, $xoopsOption, $xoopsTpl, $_POST, $_GET;

/**
 * MUST include page header
 */
require('header.php');

if (empty($_POST['submit'])) {
    if (empty($_POST['cancel'])) {//present new form for input
        $GLOBALS['xoopsOption']['template_main'] = 'xbscdm_db_update.tpl';    // Set the template page to be used
        /**
         * Xoops main header
         */

        require_once XOOPS_ROOT_PATH . '/header.php';    // include the main header file

        //Check to see if user logged in

        global $xoopsUser;

        if (empty($xoopsUser)) {
            redirect_header(CDM_URL . '/index.php?codeSet=' . CDM_DEF_SET, 1, _MD_XBSCDM_ERR_5);
        }

        /**
         * Xoops form objects
         */

        require_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';

        //Set up form fields

        $file = new \XoopsFormFile(_MD_XBSCDM_UDF1, 'fileloc', 0);

        $submit = new \XoopsFormButton('', 'submit', _MD_XBSCDM_UDF2, 'submit');

        $cancel = new \XoopsFormButton('', 'cancel', _MD_XBSCDM_UDF3, 'submit');

        $reset = new \XoopsFormButton('', 'reset', _MD_XBSCDM_UDF4, 'reset');

        $button_tray = new \XoopsFormElementTray('', '');

        $button_tray->addElement($submit);

        $button_tray->addElement($cancel);

        $button_tray->addElement($reset);

        $codeForm = new \XoopsThemeForm(_MD_XBSCDM_UDF0, 'form', 'cdm_update.php');

        $codeForm->setExtra("enctype='multipart/form-data'");

        $codeForm->addElement($file);

        $codeForm->addElement($button_tray);

        $codeForm->assign($xoopsTpl);

        require XOOPS_ROOT_PATH . '/footer.php';
    } else { //user has cancelled form
        redirect_header(CDM_URL . '/index.php?codeSet=' . CDM_DEF_SET, 5, _MD_XBSCDM_CEF14);
    }//end if empty cancel
} else { //User has submitted form
    extract($_POST);

    /**
     * file uploader utilities
     */

    require_once XOOPS_ROOT_PATH . '/class/uploader.php';

    /**
     * CDM functions
     */

    //    require_once CDM_PATH . '/include/functions.php';

    $allowed_mimetypes = ['text/plain'];

    $uploader = new \XoopsMediaUploader(XOOPS_ROOT_PATH . '/uploads', $allowed_mimetypes, 1048576);

    if ($uploader->fetchMedia($_POST['xoops_upload_file'][0])) {
        if (!$uploader->upload()) {
            redirect_header(CDM_URL . '/cdm_update.php', 1, $uploader->getErrors());
        } else {
            $msg = Utility::updateDatabase('uploads/' . $uploader->getSavedFileName(), 'modules/' . CDM_DIR . '/cdm_update.php');

            redirect_header(CDM_URL . '/index.php?codeSet=' . CDM_DEF_SET, 5, $msg);
        }
    } else {
        redirect_header(CDM_URL . '/cdm_update.php', 1, $uploader->getErrors());
    }
}//end if
