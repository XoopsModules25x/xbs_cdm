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
// URL:       http://xoobs.net			                                     //
// Project:   The XOOPS Project (http://www.xoops.org/)                      //
// Module:    Code Data Management (CDM)                                     //
// ------------------------------------------------------------------------- //
/**
* Codeset Admin page
*
* Allow administrator to create or modify Code Set data
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
xoops_module_admin_menu(1,_AM_CDM_ADMENU1);

/**
* To use this as a template you need to write code to display
* whatever it is you want displaying between here...
*/

/**
* @global array Form Post variables
*/
global $HTTP_POST_VARS;
/**
* @global array User Session variables
*/
global $_SESSION;

extract($HTTP_POST_VARS);
if (isset($submit)) { //edit the Set's record
	$_SESSION['cd_set'] = $cd_set;	//save the code set for later user
	adminEditSet($cd_set); 
} elseif (isset($insert)) { //create a new Set
	adminEditSet();
} elseif (isset($save)) { //user has edited or created a Set so save it
	$_SESSION['cd_set'] = $cd_set;	//save the code set for later user
	adminEditSet($cd_set,true);
} elseif (isset($cancel)) { 
	redirect_header(CDM_URL."/admin/adminsets.php",1,_AM_CDM_SETED101);
} else { //Present a list of code sets to select to work with
	adminSelectSet();
} //end if

/**
* and here.
*/

//And put footer in
xoops_cp_footer();

?>