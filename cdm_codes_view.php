<?php declare(strict_types=1);

use XoopsModules\Xbscdm;
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
 * Edit a single code record
 *
 * Script to present a single code record for editing and subsequent insertion
 * to database.
 *
 * @copyright (c) 2004, Ashley Kitson
 * @copyright     XOOPS Project https://xoops.org/
 * @license       GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @author        Ashley Kitson http://akitson.bbcb.co.uk
 * @author        XOOPS Development Team
 * @package       CDM
 * @subpackage    User_Interface
 * @access        private
 * @global xoopsDB     Interface to database object
 * @global xoopsTpl    Smarty template object
 * @global xoopsOption Smarty options array
 * @global array       Form POST variable array
 * @global array       Form GET variable array
 */
global $xoopsDB, $xoopsOption, $xoopsTpl;
/**
 * MUST include page header
 */
require __DIR__ . '/header.php';

if (empty($_POST['submit'])) {
    if (empty($_POST['cancel'])) { //present new form for input
        $GLOBALS['xoopsOption']['template_main'] = 'xbscdm_codes_edit.tpl'; // Set the template page to be used
        require_once XOOPS_ROOT_PATH . '/header.php'; // include the main header file
        //Check to see if user logged in
        global $xoopsUser;
        if (empty($xoopsUser)) {
            redirect_header(CDM_URL . '/index.php?codeSet=' . CDM_DEF_SET, 1, _MD_XBSCDM_ERR_5);
        }
        $codeHandler = Helper::getInstance()->getHandler('Code');
        $id          = (int)$_GET['id'];
        if (!empty($id) && 0 != $id) { //retrieve the existing data object
            $codeData = $codeHandler->getAll($id);
            $setName  = $codeData->getVar('cd_set');
        } else { //create a new object
            $codeData = $codeHandler->create();
            $setName  = $_GET['cd_set'];
            $id       = 0;
        }
        //end if
        //check object instantiated and proceed
        if ($codeData) {
            //Set up form fields
            //first get the field info from the meta record
            $metaHandler = Helper::getInstance()->getHandler('Meta');
            $meta        = $metaHandler->getAll($setName);
            $cd_len      = (int)$meta->getVar('cd_len');
            $val_len     = (int)$meta->getVar('val_len');
            $set_name    = $meta->getVar('cd_set');
            if (0 == $id) { //if id = 0 then user has requested a new code
                //present the key fields in edit boxes
                $cd = new \XoopsFormText(_MD_XBSCDM_CEF1, 'cd', $cd_len, $cd_len, '');
                //$cd_lang = new Xbscdm\Form\FormSelectLanguage(_MD_XBSCDM_CEF3,"cd_lang",CDM_DEF_LANG);
                $cd_lang  = new Xbscdm\Form\FormTreeSelect('LANGUAGE', _MD_XBSCDM_CEF3, 'cd_lang', CDM_DEF_LANG, 1, CDM_DEF_LANG, 'cd_desc');
                $new_flag = new \XoopsFormHidden('new_flag', true); //tell POST process we are new
            } else { // else display primary key as labels
                $cd          = new \XoopsFormLabel(_MD_XBSCDM_CEF1, $codeData->getVar('cd'));
                $cd_lang     = new \XoopsFormLabel(_MD_XBSCDM_CEF3, $codeData->getVar('cd_lang'));
                $cd_lang_hid = new \XoopsFormHidden('cd_lang', $codeData->getVar('cd_lang'));
                $cd_hid      = new \XoopsFormHidden('cd', $codeData->getVar('cd'));
                $new_flag    = new \XoopsFormHidden('new_flag', false);
            }
            //end if
            $id       = new \XoopsFormHidden('id', $codeData->getVar('id'));
            $cd_set   = new \XoopsFormLabel(_MD_XBSCDM_CEF2, $set_name);
            $set_hid  = new \XoopsFormHidden('cd_set', $set_name); //still need to know set name in POST process
            $cd_prnt  = new \XoopsFormText(_MD_XBSCDM_CEF4, 'cd_prnt', $cd_len, $cd_len, $codeData->getVar('cd_prnt'));
            $cd_value = new \XoopsFormText(_MD_XBSCDM_CEF5, 'cd_value', $val_len, $val_len, $codeData->getVar('cd_value'));
            $cd_desc  = new \XoopsFormTextArea(_MD_XBSCDM_CEF6, 'cd_desc', $codeData->getVar('cd_desc'));
            $cd_param = new \XoopsFormTextArea(_MD_XBSCDM_CEF16, 'cd_param', $codeData->getVar('cd_param'));
            $kids     = new \XoopsFormLabel(_MD_XBSCDM_CEF17, $codeData->getKidsHtml());
            $row_flag = new Xbscdm\Form\FormSelectRstat(_MD_XBSCDM_CEF7, 'row_flag', $codeData->getVar('row_flag'), 1, $codeData->getVar('row_flag'));
            $ret      = $xoopsUser->getUnameFromId($codeData->getVar('row_uid'), true);
            if (empty($ret)) { //if it didn't return a real name then get username/nickname
                $ret = $xoopsUser->getUnameFromId($codeData->getVar('row_uid'), false);
            }
            $row_uid  = new \XoopsFormLabel(_MD_XBSCDM_CEF8, $ret);
            $row_dt   = new \XoopsFormLabel(_MD_XBSCDM_CEF9, $codeData->getVar('row_dt'));
            $submit   = new \XoopsFormButton('', 'submit', _MD_XBSCDM_CEF10, 'submit');
            $cancel   = new \XoopsFormButton('', 'cancel', _MD_XBSCDM_CEF11, 'submit');
            $reset    = new \XoopsFormButton('', 'reset', _MD_XBSCDM_CEF12, 'reset');
            $codeForm = new \XoopsThemeForm(_MD_XBSCDM_CEF13, 'codeform', 'cdm_codes_edit.php');
            if (0 == $id) {
                $codeForm->addElement($cd, true);
                $codeForm->addElement($cd_lang, true);
            } else {
                $codeForm->addElement($cd, false);
                $codeForm->addElement($cd_lang, false);
                $codeForm->addElement($cd_hid);
                $codeForm->addElement($cd_lang_hid);
            }
            $codeForm->addElement($cd_set, false);
            $codeForm->addElement($set_hid);
            $codeForm->addElement($id);
            $codeForm->addElement($new_flag);
            $codeForm->addElement($cd_prnt, false);
            $codeForm->addElement($cd_value, true);
            $codeForm->addElement($cd_desc, false);
            $codeForm->addElement($cd_param, false);
            $codeForm->addElement($kids, false);
            $codeForm->addElement($row_flag, true);
            $codeForm->addElement($row_uid, false);
            $codeForm->addElement($row_dt, false);
            $codeForm->addElement($submit);
            $codeForm->addElement($cancel);
            $codeForm->addElement($reset);
            $codeForm->assign($xoopsTpl);
            require XOOPS_ROOT_PATH . '/footer.php';
        } else {
            print $codeHandler->getError();
        }
        //end if
    } else { //user has cancelled form
        $cd_set = $_POST['cd_set'];
        redirect_header(CDM_URL . '/index.php?codeSet=' . $cd_set, 1, _MD_XBSCDM_CEF14);
    }
    //end if empty cancel
} else { //User has submitted form
    extract($_POST);
    $codeHandler = Helper::getInstance()->getHandler('Code');
    if ($new_flag) {
        $codeData = $codeHandler->create();
        $codeData->setVar('cd_set', $cd_set);
        $codeData->setVar('cd_lang', $cd_lang);
        $codeData->setVar('cd', $cd);
    } else {
        $codeData = $codeHandler->getAll($id);
    }
    $codeData->setVar('cd_prnt', $cd_prnt);
    $codeData->setVar('cd_value', $cd_value);
    $codeData->setVar('cd_desc', $cd_desc);
    $codeData->setVar('cd_param', $cd_param);
    $codeData->setVar('row_flag', $row_flag);
    if (!$codeHandler->insert($codeData)) {
        redirect_header(CDM_URL . '/index.php?codeSet=' . $cd_set, 1, $codeHandler->getError());
    } else {
        redirect_header(CDM_URL . '/index.php?codeSet=' . $cd_set, 1, _MD_XBSCDM_CEF15);
    }
    //end if
}//end if
