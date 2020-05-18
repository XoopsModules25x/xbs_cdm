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
// $Id: cdmformselectcountry.php,v 1.0 2004/11/02 01:24:08 akitson Exp $

/**
 * Classes used by Code Data Management system to present form data
 *
 * @package       CDM
 * @subpackage    Form_Handling
 * @author        Ashley Kitson http://xoobs.net
 * @copyright (c) 2004 Ashley Kitson, Great Britain
 */

/**
 * Xoops form objects
 */
require_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';
/**
 * CDM functions
 */
//require_once CDM_PATH."/include/functions.php";

/**
 * Extends XoopsFormSelect to provide CDM functionality
 *
 * Returns only codes that are not defunct
 *
 * @package    CDM
 * @subpackage Form_Handling
 */
class CDMFormSelect extends XoopsFormSelect
{
    /**
     * Constructor
     *
     * @param string $setName Name of code set to create select list from
     * @param string $caption Caption
     * @param string $name    "name" attribute
     * @param mixed  $value   Pre-selected value (or array of them).
     * @param int    $size    Number of rows. "1" makes a drop-down-list
     * @param string $lang    The language set for the returned codes, defaults to CDM_DEF_LANG (normally EN)
     * @param string $field   The data table field to retrieve data from to display (default cd_value - the code value)
     */
    public function __construct($setName, $caption, $name, $value = null, $size = 1, $lang = CDM_DEF_LANG, $field = 'cd_value')
    {
        parent::__construct($caption, $name, $value, $size);

        $setHandler = xoops_getModuleHandler('CDMSet', CDM_DIR);

        $list_loaded = $setHandler->isListLoaded($setName, $field, false, false, $lang);

        if (!$list_loaded) {
            if ($set = $setHandler->get($setName, $lang)) {
                $arr = $set->getAbrevCodeList(); //get the data

                //sort the result

                foreach ($arr as $key => $row) {
                    $cd_value[$key] = $row[$field];
                }

                array_multisort($cd_value, SORT_ASC, $arr);

                //set up the select list

                $res = [];

                foreach ($arr as $v) {
                    $res[$v['cd']] = $v[$field];
                }

                $this->addOptionArray($res);

                $setHandler->saveList($res, $setName, $field, false, false, $lang);
            } else {
                return false;
            }
        } else {
            $this->addOptionArray($setHandler->getList($setName, $field, false, false, $lang));
        }
    }
}

//end class

/**
 * Extends XoopsFormSelect to provide CDM functionality
 *
 * Returns all codes (even defunct ones). Suffixes Suspended and Defunct codes
 *
 * @package    CDM
 * @subpackage Form_Handling
 */
class CDMFormSelectAll extends XoopsFormSelect
{
    /**
     * Constructor
     *
     * @param string $setName Name of code set to create select list from
     * @param string $caption Caption
     * @param string $name    "name" attribute
     * @param mixed  $value   Pre-selected value (or array of them).
     * @param int    $size    Number of rows. "1" makes a drop-down-list
     * @param string $lang    The language set for the returned codes, defaults to CDM_DEF_LANG (normally EN)
     * @param string $field   The data table field to retrieve data from to display (default cd_value - the code value)
     */
    public function __construct($setName, $caption, $name, $value = null, $size = 1, $lang = CDM_DEF_LANG, $field = 'cd_value')
    {
        parent::__construct($caption, $name, $value, $size);

        $setHandler = xoops_getModuleHandler('CDMSet', CDM_DIR);

        $list_loaded = $setHandler->isListLoaded($setName, $field, true, false, $lang);

        if (!$list_loaded) {
            $set = &$setHandler->getall($setName, null, null, $lang);

            if ($set) {
                $arr = $set->getAbrevCodeList(); //get the data

                //sort the result

                foreach ($arr as $key => $row) {
                    $cd_value[$key] = $row[$field];
                }

                array_multisort($cd_value, SORT_ASC, $arr);

                //set up the select list and include row_stat indicator

                $res = [];

                foreach ($arr as $v) {
                    switch ($v['row_flag']) {
                        case CDM_RSTAT_DEF:
                            $dispStr = $v[$field] . ' (' . CDM_RSTAT_DEF . ')';
                            break;
                        case CDM_RSTAT_SUS:
                            $dispStr = $v[$field] . ' (' . CDM_RSTAT_SUS . ')';
                            break;
                        default:
                            $dispStr = $v[$field];
                            break;
                    }

                    $res[$v['cd']] = $dispStr;
                }

                $this->addOptionArray($res);

                $setHandler->saveList($res, $setName, $field, true, false, $lang);
            } else { //set wasn't created because there is no data yet for the codeset
                $this->addOptionArray([-1 => 'No Codes Defined']);
            }
        } else { //we already have cached list so use it
            $this->addOptionArray($setHandler->getList($setName, $field, true, false, $lang));
        }
    }
}

/**
 * Extends XoopsFormSelect to provide CDM functionality
 *
 * Returns only codes that are not defunct
 * Presents a tree hiearchy select box based on child/parent relationships
 * of codes
 *
 * @package    CDM
 * @subpackage Form_Handling
 */
class CDMFormTreeSelect extends XoopsFormSelect
{
    /**
     * Constructor
     *
     * example: $cd_lang = new CDMFormTreeSelect('LANGUAGE',_MD_CDM_CEF3,'cd_lang',CDM_DEF_LANG,1,CDM_DEF_LANG,'cd_desc');
     *
     * @param string $setName Name of code set to create select list from
     * @param string $caption Caption
     * @param string $name    "name" attribute
     * @param mixed  $value   Pre-selected value (or array of them).
     * @param int    $size    Number of rows. "1" makes a drop-down-list
     * @param string $lang    The language set for the returned codes, defaults to CDM_DEF_LANG (normally EN)
     * @param string $dispStr The name of the variable to display to user in select list.  By default this is 'cd_value' but you may wish to use 'cd_desc' instead
     */
    public function __construct($setName, $caption, $name, $value = null, $size = 1, $lang = CDM_DEF_LANG, $dispStr = 'cd_value')
    {
        parent::__construct($caption, $name, $value, $size);

        $setHandler = xoops_getModuleHandler('CDMSet', CDM_DIR);

        $list_loaded = $setHandler->isListLoaded($setName, $dispStr, false, true, $lang);

        if (!$list_loaded) {
            $set = $setHandler->get($setName, $lang);

            if (!$set) {
                /*If set cannot be instantiated it is because either the
                 * setName doesn't exist or more probably because there are
                 * no codes for the given language ($lang).  In this case
                 * retry using 'EN    '
                */

                $set = $setHandler->get($setName, 'EN    ');
            }

            if ($set) {
                $tree = $set->getSelTreeList($dispStr);

                $this->addOptionArray($tree);

                $setHandler->saveList($tree, $setName, $dispStr, false, true, $lang);
            }
        } else {
            $this->addOptionArray($setHandler->getList($setName, $dispStr, false, true, $lang));
        }
    }
    //end function
}

//end class

/**
 * Create a Country selection list
 *
 * @package    CDM
 * @subpackage Form_Handling
 */
class CDMFormSelectCountry extends CDMFormSelect
{
    /**
     * Constructor
     *
     * @param string $caption Caption
     * @param string $name    "name" attribute
     * @param mixed  $value   Pre-selected value (or array of them).
     * @param int    $size    Number of rows. "1" makes a drop-down-list
     * @param string $lang    The language set for the returned codes, defaults to CDM_DEF_LANG (normally ENL)
     */
    public function __construct($caption, $name, $value = null, $size = 1, $lang = CDM_DEF_LANG)
    {
        parent::__construct('COUNTRY', $caption, $name, $value, $size, $lang);
    }
}

/**
 * Create a Currency selection list
 *
 * @package    CDM
 * @subpackage Form_Handling
 */
class CDMFormSelectCurrency extends CDMFormSelect
{
    /**
     * Constructor
     *
     * @param string $caption Caption
     * @param string $name    "name" attribute
     * @param mixed  $value   Pre-selected value (or array of them).
     * @param int    $size    Number of rows. "1" makes a drop-down-list
     * @param string $lang    The language set for the returned codes, defaults to CDM_DEF_LANG (normally ENL)
     */
    public function __construct($caption, $name, $value = null, $size = 1, $lang = CDM_DEF_LANG)
    {
        parent::__construct('CURRENCY', $caption, $name, $value, $size, $lang);
    }
}

/**
 * Create a language selection list
 *
 * Languages are a tree structure, so this returns a tree structure list
 *
 * @package    CDM
 * @subpackage Form_Handling
 */
class CDMFormSelectLanguage extends CDMFormTreeSelect
{
    /**
     * Constructor
     *
     * @param string $caption Caption
     * @param string $name    "name" attribute
     * @param mixed  $value   Pre-selected value (or array of them).
     * @param int    $size    Number of rows. "1" makes a drop-down-list
     * @param string $lang    The language set for the returned codes, defaults to CDM_DEF_LANG (normally EN)
     */
    public function __construct($caption, $name, $value = null, $size = 1, $lang = CDM_DEF_LANG)
    {
        parent::__construct('LANGUAGE', $caption, $name, $value, 1, $lang);
    }
}

/**
 * Create a selection list of available languages for a code set
 *
 * @package    CDM
 * @subpackage Form_Handling
 */
class CDMFormSelectSetLangs extends XoopsFormSelect
{
    /**
     * Constructor
     *
     * @param string $set     Set name
     * @param string $caption Caption
     * @param string $name    "name" attribute
     * @param mixed  $value   Pre-selected value (or array of them).
     * @param int    $size    Number of rows. "1" makes a drop-down-list
     * @param string $lang    The language set for the returned codes, defaults to CDM_DEF_LANG (normally EN)
     */
    public function __construct($set, $caption, $name, $value = null, $size = 1, $lang = CDM_DEF_LANG)
    {
        parent::__construct($caption, $name, $value, $size);

        $setHandler = xoops_getModuleHandler('CDMSet', CDM_DIR);

        $opts = $setHandler->getAvailLanguage($set);

        $this->addOptionArray($opts);

        $this->setValue($lang);
    }
}

/**
 * Create a Row Status selection list
 *
 * @package    CDM
 * @subpackage Form_Handling
 */
class CDMFormSelectRstat extends XoopsFormSelect
{
    /**
     * Constructor
     *
     * @param string $caption Caption
     * @param string $name    "name" attribute
     * @param mixed  $value   Pre-selected value (or array of them).
     * @param int    $size    Number of rows. "1" makes a drop-down-list
     * @param string $curstat Default CDM_RSTAT_ACT. If set to CDM_RSTAT_DEF, only CDM_RSTAT_DEF will be returned in the list of options, as once a record is defuncted, it stays defuncted.
     */
    public function __construct($caption, $name, $value = null, $size = 1, $curstat = CDM_RSTAT_ACT)
    {
        parent::__construct($caption, $name, $value, $size);

        if (CDM_RSTAT_DEF != $curstat) {
            $this->addOption(CDM_RSTAT_ACT, CDM_RSTAT_ACT);

            $this->addOption(CDM_RSTAT_SUS, CDM_RSTAT_SUS);
        }

        $this->addOption(CDM_RSTAT_DEF, CDM_RSTAT_DEF);
    }
}

/**
 * Create a field type selection list
 *
 * Generally only for use by CDM itself to allow user to select code data type
 * Data types allowable are INT, BIGINT, CHAR and VARCHAR
 *
 * @package    CDM
 * @subpackage Form_Handling
 */
class CDMFormSelectFldType extends XoopsFormSelect
{
    /**
     * Constructor
     *
     * @param string $caption Caption
     * @param string $name    "name" attribute
     * @param mixed  $value   Pre-selected value (or array of them).
     * @param int    $size    Number of rows. "1" makes a drop-down-list
     */
    public function __construct($caption, $name, $value = null, $size = 1)
    {
        parent::__construct($caption, $name, $value, $size);

        $this->addOption(CDM_OBJTYPE_INT, CDM_OBJTYPE_INT);

        $this->addOption(CDM_OBJTYPE_BIG, CDM_OBJTYPE_BIG);

        $this->addOption(CDM_OBJTYPE_CHR, CDM_OBJTYPE_CHR);

        $this->addOption(CDM_OBJTYPE_VAR, CDM_OBJTYPE_VAR);
    }
}

//end class

/**
 * Create a Code Set selector
 *
 * Returns all Code Sets.  Use for admin user display
 *
 * @package    CDM
 * @subpackage Form_Handling
 * @version    1
 */
class CDMFormSelectSetAll extends XoopsFormSelect
{
    /**
     * Constructor
     *
     * @param string $caption Caption
     * @param string $name    "name" attribute
     * @param mixed  $value   Pre-selected value (or array of them).
     * @param int    $size    Number of rows. "1" makes a drop-down-list
     */
    public function __construct($caption, $name, $value = null, $size = 1)
    {
        parent::__construct($caption, $name, $value, $size);

        $setHandler = xoops_getModuleHandler('CDMSet', CDM_DIR);

        $res = $setHandler->getSelectListAll();

        $this->addOptionArray($res);
    }
}

/**
 * Create a Code Set selector
 *
 * Returns Active Code Sets.  Use for user display
 *
 * @package    CDM
 * @subpackage Form_Handling
 * @version    1
 */
class CDMFormSelectSet extends XoopsFormSelect
{
    /**
     * Constructor
     *
     * @param string $caption Caption
     * @param string $name    "name" attribute
     * @param mixed  $value   Pre-selected value (or array of them).
     * @param int    $size    Number of rows. "1" makes a drop-down-list
     */
    public function __construct($caption, $name, $value = null, $size = 1)
    {
        parent::__construct($caption, $name, $value, $size);

        $setHandler = xoops_getModuleHandler('CDMSet', CDM_DIR);

        $res = $setHandler->getSelectList();

        $this->addOptionArray($res);
    }
}
