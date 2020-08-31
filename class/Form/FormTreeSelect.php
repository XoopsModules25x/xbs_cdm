<?php declare(strict_types=1);

namespace XoopsModules\Xbscdm\Form;

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
 * Presents a tree hiearchy select box based on child/parent relationships
 * of codes
 *
 * @package    CDM
 * @subpackage Form_Handling
 */
class FormTreeSelect extends \XoopsFormSelect
{
    /**
     * Constructor
     *
     * example: $cd_lang = new Xbscdm\Form\FormTreeSelect('LANGUAGE',_MD_XBSCDM_CEF3,'cd_lang',CDM_DEF_LANG,1,CDM_DEF_LANG,'cd_desc');
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

        $setHandler = \XoopsModules\Xbscdm\Helper::getInstance()->getHandler('Set');

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
