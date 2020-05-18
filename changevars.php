<?php declare(strict_types=1);

//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <https://xoops.org>                             //
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
// Project:   The XOOPS Project (https://xoops.org/)                      //
// Module:    Code Data Management (CDM)                                     //
// ------------------------------------------------------------------------- //
/**
 * Change the set and language choices for code lookup block
 *
 * Called by blocks/cdm_block_codelookup.php
 * This script has to be in module root as Xoops 2.2 security won allow it to be called
 * when it is in block directory!
 *
 * @author     Ashley Kitson http://xoobs.net
 * @copyright  2005 Ashley Kitson, UK
 * @package    CDM
 * @subpackage Blocks
 * @version    1
 * @access     private
 */

use Xmf\Request;

/**
 * Xoops mainfile
 */
//include_once('../../../mainfile.php'); //Xoops 2.0
require_once dirname(dirname(__DIR__)) . '/mainfile.php'; //Xoops 2.2
/**
 * Xoops header
 */
require_once XOOPS_ROOT_PATH . '/header.php';

/**
 * Session values
 */
global $_SESSION;
/**
 * Form get variables
 */
global $_GET;
/**
 * Server variables
 */
global $_SERVER;

if (isset($_GET['cd_set'])) {
    $_SESSION['cdm_blookup_set'] = $_GET['cd_set'];
}
if (isset($_GET['cd_lang'])) {
    $_SESSION['cdm_blookup_lang'] = $_GET['cd_lang'];
}

//and go back to the page we were on
redirect_header(Request::getString('HTTP_REFERER', '', 'SERVER'), 1);
