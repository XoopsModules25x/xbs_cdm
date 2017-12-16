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
// Copyright: (c) 2005, Ashley Kitson
// URL:       http://xoobs.net                                               //
// Project:   The XOOPS Project (http://www.xoops.org/)                      //
// Module:    Code Data Management (CDM)                                     //
// ------------------------------------------------------------------------- //
/**
* Code Lookup Block show and edit functions
* 
* @author Ashley Kitson http://xoobs.net
* @copyright 2005 Ashley Kitson, UK
* @package CDM
* @subpackage Blocks
* @version 1
* @access private
*/

//avoid declaring the functions repeatedly
if(defined('CDM_BLOOKUP_DEFINED')) return;
/**
 * Flag to tell script it is already parsed.  If set then script is exited
 */
define('CDM_BLOOKUP_DEFINED',true);

/**
 * CDM constant definitions
 */
include_once(XOOPS_ROOT_PATH."/modules/xbs_cdm/include/defines.php");
/**
 * CDM form element class
 */
include_once(CDM_PATH."/class/class.cdm.form.php");

/**
* Function: Create display data for block 
*
* Retrieve block configuration data and format block output
*
* @version 1
* @param array $options block config options
* 				[0] = Set Name
* 				[1] = Language Code
* 				[2] = Allow set change
* 				[3] = Allow language change
* @return array $block output parameters for smarty template 
*/

function b_cdm_codelookup_show($options) {
	
	//see if user has changed the set or language to display
	global $_SESSION;
	if (isset($_SESSION['cdm_blookup_set'])) {
		$setName = $_SESSION['cdm_blookup_set'];
	} else {
		$setName = $options[0];
	}
	if (isset($_SESSION['cdm_blookup_lang'])) {
		$langName = $_SESSION['cdm_blookup_lang'];
	} else {
		$langName = $options[1];
	}
	$setChange = (isset($options[2])?$options[2]==1:0);
	$langChange = (isset($options[3])?$options[3]==1:0);
    $block = array();
	
    //Form action
	$block['action'] = CDM_URL.'/blocks/changevars.php';
	//set of codes for display
	$fset = new CDMFormSelect($setName,'','cd',null,1,$langName);
	$fset->setExtra('onChange = "showCode()"');
	$block['codeset'] = $fset->render();
	$block['codesetname'] = $setName;
	$block['defcdval'] = _MB_CDM_BLOOK_DEFCDVAL;
	
	if ($setChange) {
		$setChoice = new CDMFormSelectSet('','cd_set');
		$setChoice->setValue($setName);
		$block['setchange'] = $setChoice->render();
		$block['setchangename'] = _MB_CDM_BLOOK_SETCHOICE;
	}
	//language change ability
	if ($langChange) {
		$langChoice = new CDMFormSelectSetLangs($setName,'', 'cd_lang');
		$block['langchange'] = $langChoice->render();
		$block['langchangename'] = _MB_CDM_BLOOK_LANGCHOICE;
	}
	//button if required
	if ($setChange || $langChange) {
		$submit = new XoopsFormButton("","submit",_MB_CDM_BLOOK_SUBMIT,"submit");
    	$block['submit'] = $submit->render();
	}
	
	//set up the javascript for the form
	$js = 'function showCode() {
		document.lookup_form.cvalue.value = document.lookup_form.cd.value;
	}';
	$block['javascript'] = $js;
	return $block;
}

/**
* Function: Create additional data items for block admin edit form
*
* Format a mini table for block options to be included in the
* main block admin edit form.  All data field names must be 'options[]'
* and declared in the form in the order of the parameter to this function.
*
* @version 1
* @param array $options block config options
* 				[0] = Set Name
* 				[1] = Language Code
* 				[2] = Allow set change
* 				[3] = Allow language change
* @return array $form Output html for smarty template
*/

function b_cdm_codelookup_edit($options) {
	
	/*create input fields using XoopsForm objects
   	* It is clearer to use XoopsForm object->render() to create the form elements
	* rather than hand coding the html.	
	*/
	$fld = array();
	$s = new CDMFormSelectSet('','options[]');
	$s->setValue($options[0]);
	$fld[0] = $s->render();
	unset($s);
	$s = new CDMFormSelectLanguage('', 'options[]');
	$s->setValue($options[1]);
	$fld[1] = $s->render();
	unset($s);
	if (!isset($options[2])) { $options[2] = 0; }
	$s = new XoopsFormCheckBox('', 'options[]', $options[2]);
	$s->addOption('1','Yes');
	$fld[2] = $s->render();
	unset($s);
	if (!isset($options[3])) { $options[3] = 0; }
	$s = new XoopsFormCheckBox('', 'options[]', $options[3]);
	$s->addOption('1','Yes');
	$fld[3] = $s->render();
	unset($s);
	
	//construct the table that will be placed into the admin form
	$form = "<table>";
	$form .='<tr><td>'._MB_CDM_BLOOK_SETCHOICE.'</td><td>'.$fld[0].'</td></tr>';
	$form .='<tr><td>'._MB_CDM_BLOOK_LANGCHOICE.'</td><td>'.$fld[1].'</td></tr>';
	$form .='<tr><td>'._MB_CDM_BLOOK_ALLOWSETCHANGE.'</td><td>'.$fld[2].'</td></tr>';
	$form .='<tr><td>'._MB_CDM_BLOOK_ALLOWLANGCHANGE.'</td><td>'.$fld[3].'</td></tr>';
	$form .= "</table>";
	return $form;
}
?>