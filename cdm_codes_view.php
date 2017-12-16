<?php
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <http://www.xoops.org/>                             //
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
// URL:       http://xoobs.net			                                     //
// Project:   The XOOPS Project (http://www.xoops.org/)                      //
// Module:    Code Data Management (CDM)                                     //
// ------------------------------------------------------------------------- //
/** 
 * Edit a single code record
 * 
 * Script to present a single code record for editing and subsequent insertion
 * to database.
 * 
 * @author Ashley Kitson http://xoobs.net
 * @copyright (c) 2004, Ashley Kitson
 * @package CDM
 * @subpackage User_Interface
 * @access private
 * @global xoopsDB Interface to database object
 * @global xoopsTpl Smarty template object
 * @global xoopsOption Smarty options array
 * @global array Form POST variable array
 * @global array Form GET variable array
*/
global $xoopsDB, $xoopsOption, $xoopsTpl, $HTTP_POST_VARS, $HTTP_GET_VARS;

/**
* MUST include page header
*/
require("header.php");

if (empty($HTTP_POST_VARS['submit'])) { 
  if (empty($HTTP_POST_VARS['cancel'])) {//present new form for input
    $xoopsOption['template_main'] = 'cdm_codes_edit.tpl';	// Set the template page to be used
    require_once XOOPS_ROOT_PATH."/header.php";	// include the main header file
    /**
    * include class.cdm.form.php to use CDM form elements
    */
    require_once CDM_PATH."/class/class.cdm.form.php";
    
    //Check to see if user logged in
    Global $xoopsUser;
    if (empty($xoopsUser)) redirect_header(CDM_URL."/index.php?codeSet=".CDM_DEF_SET,1,_MD_CDM_ERR_5);
    $codeHandler =& xoops_getmodulehandler("CDMCode",CDM_DIR);
    $id = intval($HTTP_GET_VARS['id']);
    if (!empty($id) && $id!=0) { //retrieve the existing data object
      $codeData =& $codeHandler->getall($id);
      $setName = $codeData->getVar('cd_set');
    } else { //create a new object
      $codeData =& $codeHandler->create(); 
      $setName = $HTTP_GET_VARS['cd_set'];
      $id=0;
    }//end if
    //check object instantiated and proceed
    if ($codeData) {
      //Set up form fields
      //first get the field info from the meta record
      $metaHandler =& xoops_getmodulehandler("CDMMeta",CDM_DIR);
      $meta =& $metaHandler->getall($setName);
      $cd_len = intval($meta->getVar('cd_len'));
      $val_len = intval($meta->getVar('val_len'));      
      $set_name = $meta->getVar("cd_set");
      
      if ($id==0) { //if id = 0 then user has requested a new code
		//present the key fields in edit boxes
		$cd = new XoopsFormText(_MD_CDM_CEF1,"cd",$cd_len,$cd_len,"");
		//$cd_lang = new CDMFormSelectLanguage(_MD_CDM_CEF3,"cd_lang",CDM_DEF_LANG);
		$cd_lang = new CDMFormTreeSelect('LANGUAGE',_MD_CDM_CEF3,'cd_lang',CDM_DEF_LANG,1,CDM_DEF_LANG,'cd_desc');
		$new_flag = new XoopsFormHidden("new_flag",TRUE); //tell POST process we are new
	  } else { // else display primary key as labels
		$cd = new XoopsFormLabel(_MD_CDM_CEF1,$codeData->getVar('cd'));
		$cd_lang = new XoopsFormLabel(_MD_CDM_CEF3,$codeData->getVar('cd_lang'));
		$cd_lang_hid = new XoopsFormHidden("cd_lang",$codeData->getVar('cd_lang'));
		$cd_hid = new XoopsFormHidden("cd",$codeData->getVar('cd'));
		$new_flag = new XoopsFormHidden("new_flag",FALSE);
      }//end if
      $id = new XoopsFormHidden("id",$codeData->getVar("id"));
      $cd_set = new XoopsFormLabel(_MD_CDM_CEF2,$set_name);
      $set_hid = new XoopsFormHidden("cd_set",$set_name); //still need to know set name in POST process
      $cd_prnt = new XoopsFormText(_MD_CDM_CEF4,"cd_prnt",$cd_len,$cd_len,$codeData->getVar("cd_prnt"));
      $cd_value = new XoopsFormText(_MD_CDM_CEF5,"cd_value",$val_len,$val_len,$codeData->getVar("cd_value"));
      $cd_desc = new XoopsFormTextArea(_MD_CDM_CEF6,"cd_desc",$codeData->getVar("cd_desc"));
      $cd_param = new XoopsFormTextArea(_MD_CDM_CEF16,"cd_param",$codeData->getVar("cd_param"));
      $kids = new XoopsFormLabel(_MD_CDM_CEF17,$codeData->getKidsHtml());
      $row_flag = new CDMFormSelectRstat(_MD_CDM_CEF7,"row_flag",$codeData->getVar("row_flag"),1,$codeData->getVar("row_flag"));

      $ret = $xoopsUser->getUnameFromId($codeData->getVar("row_uid"),TRUE);
      if (empty($ret)) { //if it didn't return a real name then get username/nickname
	$ret = $xoopsUser->getUnameFromId($codeData->getVar("row_uid"),FALSE);
      }
      $row_uid = new XoopsFormLabel(_MD_CDM_CEF8,$ret);
      $row_dt = new XoopsFormLabel(_MD_CDM_CEF9,$codeData->getVar('row_dt'));
      $submit = new XoopsFormButton("","submit",_MD_CDM_CEF10,"submit");
      $cancel = new XoopsFormButton("","cancel",_MD_CDM_CEF11,"submit");
      $reset = new XoopsFormButton("","reset",_MD_CDM_CEF12,"reset");
      $codeForm = new XoopsThemeForm(_MD_CDM_CEF13,"codeform","cdm_codes_edit.php");

      if ($id==0) {
	$codeForm->addElement($cd,true);
	$codeForm->addElement($cd_lang,true);
      } else {
	$codeForm->addElement($cd,false);
	$codeForm->addElement($cd_lang,false);
	$codeForm->addElement($cd_hid);
	$codeForm->addElement($cd_lang_hid);
      }
      $codeForm->addElement($cd_set,false);
      $codeForm->addElement($set_hid);
      $codeForm->addElement($id);
      $codeForm->addElement($new_flag);
      $codeForm->addElement($cd_prnt,false);
      $codeForm->addElement($cd_value,true);
      $codeForm->addElement($cd_desc,false);
      $codeForm->addElement($cd_param,false);
      $codeForm->addElement($kids,false);
      $codeForm->addElement($row_flag,true);
      $codeForm->addElement($row_uid,false);
      $codeForm->addElement($row_dt,false);
      $codeForm->addElement($submit);
      $codeForm->addElement($cancel);
      $codeForm->addElement($reset);
      $codeForm->assign($xoopsTpl);
      include XOOPS_ROOT_PATH."/footer.php";
    } else {
      print $codeHandler->getError();
    }//end if
  } else { //user has cancelled form
    $cd_set = $HTTP_POST_VARS['cd_set'];
    redirect_header(CDM_URL."/index.php?codeSet=".$cd_set,1,_MD_CDM_CEF14);
  }//end if empty cancel
} else { //User has submitted form
  extract($HTTP_POST_VARS);
  $codeHandler =& xoops_getmodulehandler("CDMCode",CDM_DIR);
  if ($new_flag) {
    $codeData =& $codeHandler->create();
    $codeData->setVar('cd_set',$cd_set);
    $codeData->setVar('cd_lang',$cd_lang);
    $codeData->setVar('cd',$cd);
  } else {
    $codeData =& $codeHandler->getall($id);
  }

  $codeData->setVar('cd_prnt',$cd_prnt);
  $codeData->setVar('cd_value',$cd_value);
  $codeData->setVar('cd_desc',$cd_desc);
  $codeData->setVar('cd_param',$cd_param);
  $codeData->setVar('row_flag',$row_flag);

  if (!$codeHandler->insert($codeData)) {
    redirect_header(CDM_URL."/index.php?codeSet=".$cd_set,1,$codeHandler->getError()); 
  } else {
    redirect_header(CDM_URL."/index.php?codeSet=".$cd_set,1,_MD_CDM_CEF15);
  }//end if
}//end if




?>
