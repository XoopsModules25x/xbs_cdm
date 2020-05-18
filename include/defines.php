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
 * Constant definitions that are programming specific rather than
 * module or language specific
 *
 * @package       CDM
 * @subpackage    Definitions
 * @author        Ashley Kitson http://xoobs.net
 * @copyright (c) 2004 Ashley Kitson, Great Britain
 */

/**
 * The CDM module directory name
 *
 * cannot use dirname as it doesn't nest (i.e not correct if CDM being used from within another module)
 * <code>
 * define('CDM_DIR', $xoopsModule->dirname());
 * </code>
 */
define('CDM_DIR', 'xbs_cdm');

/**
 * Function: Get the current module's configuration options
 *
 * Because CDM can be nested inside other modules the $xoopsModuleConfig
 * variable will be pointing to whatever module is currently in scope
 * We therefore need to retrieve the CDM options
 *
 * @return array Module config options
 * @internal
 * @version 1
 */
function getCDMModConfigs()
{
    static $CDMModuleConfig;

    if (isset($CDMModuleConfig)) {
        return $CDMModuleConfig;
    }

    $moduleHandler = xoops_getHandler('module');

    if ($Module = $moduleHandler->getByDirname(CDM_DIR)) {
        $configHandler = xoops_getHandler('config');

        $CDMModuleConfig = $configHandler->getConfigsByCat(0, $Module->getVar('mid'));
    }

    return $CDMModuleConfig;
}

/**
 * Retrieve config values to set up constants
 *
 * This will throw PHP debug notices during module installation
 * so we check first to see if the $xoopsModuleConfig var is declared
 */
$cfg = getCDMModConfigs();
if (isset($cfg)) {
    $_def_lang = $cfg['def_lang'];

    $_def_codeset = $cfg['def_codeset'];
} else {
    $_def_codeset = 'BASE';

    $_def_lang = 'EN';
}

/**#@+
 * Constants for cdm objects
 */

/**
 * Full file path to CDM directory
 */
define('CDM_PATH', XOOPS_ROOT_PATH . '/modules/' . CDM_DIR);
/**
 * URL to CDM
 */
define('CDM_URL', XOOPS_URL . '/modules/' . CDM_DIR);

/**
 * Constants used to describe row status of object
 */
/**
 * object is active and useable
 */
define('CDM_RSTAT_ACT', 'Active');
/**
 * object is permanently suspended and not useable
 */
define('CDM_RSTAT_DEF', 'Defunct');
/**
 * object is temporarily suspended from use
 */
define('CDM_RSTAT_SUS', 'Suspended');

/**
 * Constants used to define code and code_value data types
 */
/**
 * Integer
 */
define('CDM_OBJTYPE_INT', 'INTEGER');
/**
 * Bigint
 */
define('CDM_OBJTYPE_BIG', 'BIGINT');
/**
 * Char
 */
define('CDM_OBJTYPE_CHR', 'CHAR');
/**
 * Varchar
 */
define('CDM_OBJTYPE_VAR', 'VARCHAR');

/**
 * Constant defs for tables used by CDM
 */
/**
 * code table
 */
define('CDM_TBL_CODE', 'cdm_code');
/**
 * meta table
 */
define('CDM_TBL_META', 'cdm_meta');
/**
 * selector list cache table
 */
define('CDM_TBL_LIST', 'cdm_list');

/**
 * Other constants
 */

/**
 * default language for a code
 * Set character length of language constant.  This is required because
 * a number of functions need to match against this exactly, and the
 * value retrieved from the database is always padded out to the exact character
 * length (by default char(6))
 */
define('CDM_DEF_LANG', str_pad(mb_substr($_def_lang, 0, 6), 6));
//define('CDM_DEF_LANG','EN');
/**
 * default codeset for a code
 */
define('CDM_DEF_SET', $_def_codeset);
//define('CDM_DEF_SET','BASE');

/**#@-*/
