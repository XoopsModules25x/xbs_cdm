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
// Copyright: (c) 2004, Ashley Kitson
// URL:       http://xoobs.net                                               //
// Project:   The XOOPS Project (https://xoops.org/)                      //
// Module:    Code Data Management (CDM)                                     //
// ------------------------------------------------------------------------- //

/**
 * Module install, uninstall and update scripts
 *
 * Callback functions that are called during module update, install and delete
 * processing.
 *
 * @author        Ashley Kitson http://xoobs.net
 * @copyright (c) 2004, Ashley Kitson
 * @package       CDM
 * @subpackage    Installation
 * @access        private
 * @param mixed $module
 * @param mixed $oldVersion
 */

/**
 * function xoops_module_update_cdm
 *
 * module update function
 *
 * @param xoopsModule &$module     Handle to current module
 * @param int          $oldVersion version of module prior to update
 *
 * @return bool True if success else False
 * @global            xoopsDB     xoopsDatabase object
 *
 */
function xoops_module_update_cdm($module, $oldVersion)
{
    global $xoopsDB;

    if ($oldVersion < 110) { //upgrading from version 1.00
        //add a new column to cdm_code table

        $sql = 'ALTER TABLE ' . $xoopsDB->prefix(cdm_code) . ' ADD cd_param VARCHAR(255) AFTER cd_desc';

        $ret = ($result = $xoopsDB->queryF($sql));

        if (!$ret) {
            $module->setErrors('Unable to execute query "' . $sql . '" whilst updating CDM module');

            return false;
        }
    }

    if ($oldVersion < 120) { //upgrading from version 1.10
        //perform other upgrading stuff
    }

    if ($oldVersion < 130) { //upgrading from version 1.20
        //perform other upgrading stuff
    }

    if ($oldVersion < 140) { //upgrading from version 1.30
        //perform other upgrading stuff
    }

    if ($oldVersion < 150) { //upgrading from version 1.40
        //perform other upgrading stuff
    }

    return true;
}

//end function

/**
 * function xoops_module_install_cdm
 *
 * module install function
 *
 * @param xoopModule &$module Handle to current module
 *
 * @return bool True if success else False
 */
function xoops_module_install_cdm(&$module)
{
    //The basic SQL install is done via the SQL script

    return true;
}

//end function

/**
 * function xoops_module_uninstall_cdm
 *
 * module uninstall function
 *
 * @param xoopModule &$module Handle to current module
 *
 * @return bool True if success else False
 */
function xoops_module_uninstall_cdm(&$module)
{
    //CDM tables are deleted via the Xoops uninstaller

    return true;
}

//end function
