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
* Code Admin page
*
* Allow administrator to create or modify code data
*
* @author Ashley Kitson http://xoobs.net
* @copyright 2005 Ashley Kitson, UK
* @package CDM
* @subpackage Admin
* @version 1
* @access private
*/

/**
* Do all the declarations etc needed by an admin page
*/
include_once "adminheader.php";

//Display the admin menu
xoops_module_admin_menu(2,_AM_CDM_ADMENU2);

/**
* To use this as a template you need to write code to display
* whatever it is you want displaying between here...
*/

/**
* @global array Form Post variables
*/
global $HTTP_POST_VARS;
/**
* @global array Get variables
*/
global $HTTP_GET_VARS;
/**
* @global array User Session variables
*/
global $_SESSION;

extract($HTTP_POST_VARS);
if (isset($go)) { //edit the Code's record
	$_SESSION['cd_set'] = $cd_set;	//save the code data for later user
	$_SESSION['cd'] = $cd;
	$_SESSION['cd_lang'] = $cd_lang;
	adminEditCode($cd_set,$cd,$cd_lang); 
} elseif (isset($insert)) { //create a new code
	$_SESSION['cd_set'] = $cd_set;	//save the code data for later user
	$_SESSION['cd_lang'] = $cd_lang;
	adminEditCode($cd_set,null,$cd_lang);
} elseif (isset($save)) { //user has edited or created a code so save it
	$_SESSION['cd_set'] = $cd_set;	//save the code data for later user
	$_SESSION['cd'] = $cd;
	$_SESSION['cd_lang'] = $cd_lang;
	adminEditCode($cd_set,$cd,$cd_lang,true);
} elseif (isset($cancel)) { 
	redirect_header(CDM_URL."/admin/admincodes.php?gsubmit=1",1,_AM_CDM_CODED101);
} elseif (isset($submit)) { //user has selected codeset & lang so allow choice of code to edit
	$_SESSION['cd_set'] = $cd_set;	//save the code data for later user
	$_SESSION['cd_lang'] = $cd_lang;
	adminSelectCode($cd_set,$cd_lang);
}
 else { 
	extract($HTTP_GET_VARS);
	if (isset($gsubmit)) {	//user has just commited or cancelled a record save so allow them to choos e a new code to edit
		extract($_SESSION);
		adminSelectCode($cd_set,$cd_lang);
	} else { //Present a list of code sets to select to work with
 		adminSelectCode();
	}
} //end if

/**
* and here.
*/

//And put footer in
xoops_cp_footer();

?>