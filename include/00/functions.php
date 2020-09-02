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
// SubModule: Common functions
// ------------------------------------------------------------------------- //

/**
 * API Functions
 *
 * @param mixed $codeSet
 * @param mixed $lang
 * @copyright (c) 2004, Ashley Kitson
 * @copyright     XOOPS Project https://xoops.org/
 * @license       GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @author        Ashley Kitson http://akitson.bbcb.co.uk
 * @author        XOOPS Development Team
 * @package       CDM
 * @subpackage    API_Functions
 */

use XoopsModules\Xbscdm\Helper;

/**
 * Return a code set
 *
 * @param string $codeSet Name of code set
 * @param string $lang    Language set for code set
 *
 * @return Set
 */
function CDMGetCodeSet($codeSet, $lang = CDM_DEF_LANG)
{
    $setHandler = Helper::getInstance()->getHandler('Set');

    return $setHandler->get($codeSet, $lang);
}

/**
 * Return a code object
 *
 * @param string $codeSet Name of code set
 * @param string $codeKey Name of code
 * @param string $lang    Language set for code set
 *
 * @return Code
 */
function CDMGetCodeObj($codeSet, $codeKey, $lang = CDM_DEF_LANG)
{
    $set = CDMGetCodeSet($codeset, $lang);

    $code = null;

    foreach ($set as $inst) {
        if ($inst->getValue('cd') == $codeKey) {
            $code = $inst;

            break;
        }
    }

    return $code;
}

/**
 * Return a code value given a set and code key
 *
 * @param string $codeSet Name of code set
 * @param string $codeKey Name of code
 * @param string $lang    Language set for code set
 *
 * @return string The code value
 */
function CDMGetCode($codeSet, $codeKey, $lang = CDM_DEF_LANG)
{
    $set = CDMGetCodeSet($codeSet, $lang);

    $codes = $set->getAbrevCodeList(); //cd, cd_value array

    $value = null;

    foreach ($codes as $k) {
        if ($k['cd'] == $codeKey) {
            $value = $k['cd_value'];

            break;
        }
    }

    return $value;
}

/**
 * Get parameters for a code given a set and code key
 *
 * @param string $codeSet Name of code set
 * @param string $codeKey Name of code
 * @param string $lang    Language set for code set
 *
 * @return string The parameter string for the code
 */
function CDMGetParams($codeSet, $codeKey, $lang = CDM_DEF_LANG)
{
    $code = CDMGetCodeObj($codeSet, $codeKey, $lang);

    if (!empty($code)) {
        return $code->getValue('cd_param');
    }

    return null;
}

/**
 * Check a code for a given value.
 *
 * Return true if value correct else false
 *
 * @param string $codeSet Name of code set
 * @param string $codeKey Name of code
 * @param string $value   Value to check for
 * @param string $lang    Language set for code set
 *
 * @return bool
 */
function CDMCheckCode($codeSet, $codeKey, $value, $lang = CDM_DEF_LANG)
{
    $code = CDMGetCode($codeSet, $codeKey, $lang);

    return $code == $value;
}

/**
 * Return a valid xoops user name given the user id
 *
 * @param int $id Xoops user id
 *
 * @return string Xoops real name if available else the logon/username
 * @global    xoopsUser Xoops user object
 *
 */
function getXoopsUser($id)
{
    global $xoopsUser;

    $ret = $xoopsUser->getUnameFromId($id, true);

    if (empty($ret)) { //if it didn't return a real name then get username/nickname
        $ret = $xoopsUser->getUnameFromId($id, false);
    }

    return $ret;
}

/**
 * Function: updateDatabase
 *
 * Takes a SQL command file and applies it to the current Xoops database
 *
 * @param string $sqlFile   url (relative to XOOPS_ROOT_PATH) of sql file to process (no leading slash)
 * @param string $errorPage url (relative to XOOPS_ROOT_PATH) of page to redirect to if an error occurs (no leading slash)
 *
 * @return string Processing messages for display on Success else no return and redirect to specified page
 * @version 1
 *
 */
function updateDatabase($sqlFile, $errorPage)
{
    $db = XoopsDatabaseFactory::getDatabaseConnection();

    $reservedTables = [
        'avatar',
        'avatar_users_link',
        'block_module_link',
        'xoopscomments',
        'config',
        'configcategory',
        'configoption',
        'image',
        'imagebody',
        'imagecategory',
        'imgset',
        'imgset_tplset_link',
        'imgsetimg',
        'groups',
        'groups_users_link',
        'group_permission',
        'online',
        'bannerclient',
        'banner',
        'bannerfinish',
        'priv_msgs',
        'ranks',
        'session',
        'smiles',
        'users',
        'newblocks',
        'modules',
        'tplfile',
        'tplset',
        'tplsource',
        'xoopsnotifications',
        'banner',
        'bannerclient',
        'bannerfinish',
    ];

    $error = false;

    if (false !== $sqlFile) {
        $sql_file_path = XOOPS_ROOT_PATH . '/' . $sqlFile;

        if (!file_exists($sql_file_path)) {
            $errs[] = sprintf(_MD_XBSCDM_ERR_20, $sql_file_path);

            $error = true;
        } else {
            $msgs[] = sprintf(_MD_XBSCDM_ERR_21, $sql_file_path);

            /**
             * SQL Database utilities
             */

            require_once CDM_PATH . '/include/sqlutility.php';

            $sql_query = fread(fopen($sql_file_path, 'rb'), filesize($sql_file_path));

            $sql_query = trim($sql_query);

            SqlUtility::splitMySqlFile($pieces, $sql_query);

            $pref = $db->prefix();

            $pattern = '/^SET @LANG/isU';

            $lang_found = false;

            foreach ($pieces as $piece) {
                // check for the language setting statement for the imported data

                // It should be the first statement otherwise the file won't get processed

                // as lines are skipped until the language statement is found.

                if (!$lang_found) {
                    if (preg_match($pattern, $piece)) {
                        $matches = preg_split('/=/', $piece);

                        //get the $lang value

                        $lang_found = true;

                        $lang = trim($matches[1]);
                    }
                    //end if
                } else { //process the file and run SQL statements in it
                    // [0] contains the prefixed query
                    // [4] contains unprefixed table name
                    $prefixed_query = SqlUtility::prefixQuery($piece, $pref, $lang);

                    if (!$prefixed_query) {
                        $errs[] = sprintf(_MD_XBSCDM_ERR_22, $piece);

                        $error = true;

                        break;
                    }

                    //end if

                    // check if the table name is reserved

                    if (!in_array($prefixed_query[4], $reservedTables)) {
                        // not reserved, so try to create one

                        if (!$db->query($prefixed_query[0])) {
                            $errs[] = $db->error() . ' String = ' . $piece;

                            $error = true;

                            break;
                        }

                        $msgs[] = '&nbsp;&nbsp;' . sprintf(_MD_XBSCDM_ERR_23, $db->prefix($prefixed_query[0]));
                        //end else
                    } else {
                        // the table name is reserved, so halt the installation

                        $errs[] = sprintf(_MD_XBSCDM_ERR_24, $prefixed_query[4]);

                        $error = true;

                        break;
                    }
                    //end else
                }
                //end else $lang_found
            }
            //end foreach
        }
        //end else
    }

    //end of sql processing

    //if in error redirect to error page else return success messages to caller

    if (true === $error) {
        $ret = '<p><code>';

        foreach ($errs as $er) {
            $ret .= '&nbsp;&nbsp;' . $er . '<br>';
        }

        $ret .= '</code><br>';

        unset($msgs);

        unset($errs);

        redirect_header(XOOPS_URL . '/' . $errorPage, 1, $ret);
    } else {
        $ret = '<p><code>';

        foreach ($msgs as $m) {
            $ret .= $m . '<br>';
        }

        $ret .= '<p>';

        $ret .= '</code><br>';

        unset($msgs);

        unset($errs);

        return $ret;
    }
    //end if in error
}

//end function
