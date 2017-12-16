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
// URL:       http://akitson.bbcb.co.uk                                      //
// Project:   The XOOPS Project (http://www.xoops.org/)                      //
// Module:    Code Data Management (CDM)                                     //
// ------------------------------------------------------------------------- //
/** 
 * Edit a single meta record
 * 
 * Script to present a single meta data record for editing and subsequent insertion
 * to database.
 * 
 * @author Ashley Kitson http://akitson.bbcb.co.uk
 * @copyright (c) 2004, Ashley Kitson
 * @package CDM
 * @subpackage User_Interface
 * @global mixed Xoops user object
 * @global array Form POST variable array
 */

global $xoopsUser, $HTTP_POST_VARS;

/**
* Must include page header
*/
require("header.php");	
/**
* Main Xoops header
*/
include XOOPS_ROOT_PATH."/header.php";
/**
* include class.cd.form.php to use CDM Form elements
*/
require_once CDM_PATH."/class/class.cdm.form.php";  
/**
* CDM common functions
*/
require_once CDM_PATH."/include/functions.php";     

//Check to see if user logged in
if (empty($xoopsUser)) redirect_header(CDM_URL."/index.php?codeSet=".CDM_DEF_SET,1,_MD_CDM_ERR_5);

/**
 * Display meta record edit form
 */
function dispForm() {
  /**
  * @global Smarty_options_array $xoopsOption
  */
	global $xoopsOption;
  /**
  * @global Smarty_template_object $xoopsTpl
  */
  global $xoopsTpl;
  /**
  * @global array $HTTP_GET_VARS  
  */
  global $HTTP_GET_VARS;

  $xoopsOption['template_main'] = 'cdm_meta_edit.tpl';	// Set the template page to be used
  $metaHandler =& xoops_getmodulehandler("CDMMeta",CDM_DIR);
  $id = strval($HTTP_GET_VARS['codeSet']);
  //    print($id."<br>");
  if (!empty($id) && $id!="0") { //retrieve the existing data object
    $metaData =& $metaHandler->getall($id);
  } else { //create a new meta object
    $metaData =& $metaHandler->create(); 
    $id="0";
  }//end if
   //check object instantiated and proceed
  if ($metaData) {
    //Set up form fields
    if ($id=="0") { //if id = "0" then user has requested a new code setup so present edit box
      $cd_set = new XoopsFormText(_MD_CDM_MEF1,"cd_set",10,10,"");
      $new_flag = new XoopsFormHidden("new_flag",TRUE); //tell POST process we are new
    } else { // else display the current set name as a label because it is primary key
      $cd_set = new XoopsFormLabel(_MD_CDM_MEF1,$metaData->getVar("cd_set"));
      $set_hid = new XoopsFormHidden("cd_set",$metaData->getVar("cd_set")); //still need to know set name in POST process
      $new_flag = new XoopsFormHidden("new_flag",FALSE);
    }//end if
    $cd_type = new CDMFormSelectFldType(_MD_CDM_MEF2,"cd_type",$metaData->getVar("cd_type"));
    $cd_len = new XoopsFormText(_MD_CDM_MEF3,"cd_len",3,3,$metaData->getVar("cd_len"));
    $val_type = new CDMFormSelectFldType(_MD_CDM_MEF4,"val_type",$metaData->getVar("val_type"));
    $val_len = new XoopsFormText(_MD_CDM_MEF5,"val_len",3,3,$metaData->getVar("val_len"));
    $cd_desc = new XoopsFormTextArea(_MD_CDM_MEF6,"cd_desc",$metaData->getVar("cd_desc"));
    $row_flag = new CDMFormSelectRstat(_MD_CDM_MEF7,"row_flag",$metaData->getVar("row_flag"),1,$metaData->getVar("row_flag"));
    $ret = getXoopsUser($metaData->getVar("row_uid"));
    $row_uid = new XoopsFormLabel(_MD_CDM_MEF8,$ret);
    $row_dt = new XoopsFormLabel(_MD_CDM_MEF9,$metaData->getVar('row_dt'));
    $submit = new XoopsFormButton("","submit",_MD_CDM_MEF10,"submit");
    $cancel = new XoopsFormButton("","cancel",_MD_CDM_MEF11,"submit");
    $reset = new XoopsFormButton("","reset",_MD_CDM_MEF12,"reset");
    $metaForm = new XoopsThemeForm(_MD_CDM_MEF13,"metaform","cdm_meta_edit.php"); 
    if ($id=="0") {
      $metaForm->addElement($cd_set,true);
    } else {
      $metaForm->addElement($cd_set,false);
      $metaForm->addElement($set_hid);
    }
    $metaForm->addElement($new_flag);
    $metaForm->addElement($cd_type,true);
    $metaForm->addElement($cd_len,true);
    $metaForm->addElement($val_type,true);
    $metaForm->addElement($val_len,true);
    $metaForm->addElement($cd_desc,false);
    $metaForm->addElement($row_flag,true);
    $metaForm->addElement($row_uid,false);
    $metaForm->addElement($row_dt,false);
    $metaForm->addElement($submit);
    $metaForm->addElement($cancel);
    $metaForm->addElement($reset);
    $metaForm->assign($xoopsTpl);
  }
} //end function dispForm

/**
 * Submit meta form data to database
 *
 * @global array $HTTP_POST_VARS
 */
function submitForm() {
  global $HTTP_POST_VARS;
  extract($HTTP_POST_VARS);
  $metaHandler =& xoops_getmodulehandler("CDMMeta",CDM_DIR);
  if ($new_flag) {
    $metaData =& $metaHandler->create();
    $metaData->setVar('cd_set',$cd_set);
  } else {
    $metaData =& $metaHandler->getall($cd_set);
  }
  $metaData->setVar('cd_type',$cd_type);
  $metaData->setVar('cd_len',$cd_len);
  $metaData->setVar('val_type',$val_type);
  $metaData->setVar('val_len',$val_len);
  $metaData->setVar('cd_desc',$cd_desc);
  $metaData->setVar('row_flag',$row_flag);
  if (!$metaHandler->insert($metaData)) {
    redirect_header(CDM_URL."/index.php?codeSet=".$cd_set,1,$metaHandler->getError()); 
  } else {
    redirect_header(CDM_URL."/index.php?codeSet=".$cd_set,1,_MD_CDM_MEF15);
  }//end if
} //end function submitForm

/* Main program block */
//if submit and cancel buttons not pressed then display a form
if (empty($HTTP_POST_VARS['submit'])) { 
  if (empty($HTTP_POST_VARS['cancel'])) {//present new form for input
    dispForm();
    include XOOPS_ROOT_PATH."/footer.php";
  } else { //user has cancelled form
    $cd_set = $HTTP_POST_VARS['cd_set'];
    redirect_header(CDM_URL."/index.php?codeSet=".$cd_set,1,_MD_CDM_MEF14);
  }//end if empty cancel
} else { //User has submitted form
  submitForm();
}//end if

?>
