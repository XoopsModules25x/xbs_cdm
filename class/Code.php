<?php declare(strict_types=1);

namespace XoopsModules\Xbscdm;

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
 * Base classes used by Code Data Management system
 *
 * @package       CDM
 * @subpackage    CDMBase
 * @author        Ashley Kitson http://xoobs.net
 * @copyright (c) 2004 Ashley Kitson, Great Britain
 */

/**
 * Require Xoops kernel objects so we can extend them
 */
require_once XOOPS_ROOT_PATH . '/kernel/object.php';

/**
 * Code object
 *
 * A code is a single item in a code set.  To instantiate this object use:
 * <code>
 * $codeHandler = xoops_getModuleHandler("Code",CDM_DIR);
 * $codeData =& $codeHandler->get($id); //$id is the required internal id of the code
 * </code>
 *
 * @package    CDM
 * @subpackage Code
 */
class Code extends BaseObject
{
    /**
     * Constructor
     *
     * The following variables are instantiated for access via ->getVar()
     * <code>
     * $this->initVar('id',XOBJ_DTYPE_INT,null,TRUE);
     * $this->initVar('cd_set',XOBJ_DTYPE_TXTBOX,null,TRUE,10);
     * $this->initVar('cd_lang',XOBJ_DTYPE_TXTBOX,null,TRUE,10);
     * $this->initVar('cd',XOBJ_DTYPE_TXTBOX,null,TRUE,10);
     * $this->initVar('cd_prnt',XOBJ_DTYPE_TXTBOX,null,FALSE,10);
     * $this->initVar('cd_value',XOBJ_DTYPE_TXTBOX,null,TRUE,50);
     * $this->initVar('cd_desc',XOBJ_DTYPE_TXTAREA,null,FALSE,255);
     * $this->initVar('cd_param',XOBJ_DTYPE_TXTAREA,null,FALSE,255);
     * $this->initVar('_kidsint',XOBJ_DTYPE_OTHER,null);
     * $this->initVar('_kidscode',XOBJ_DTYPE_OTHER,null);
     * $this->initVar('_cd_type',XOBJ_DTYPE_OTHER,null);//code data type
     * $this->initVar('_cd_len',XOBJ_DTYPE_OTHER,null);//code data lenth
     * $this->initVar('_val_type',XOBJ_DTYPE_OTHER,null);//value data type
     * $this->initVar('_val_len',XOBJ_DTYPE_OTHER,null);//value data length
     * </code>
     */

    public function __construct()
    {
        //constructor
        $this->initVar('id', XOBJ_DTYPE_INT, null, true);

        $this->initVar('cd_set', XOBJ_DTYPE_TXTBOX, null, true, 10);

        $this->initVar('cd_lang', XOBJ_DTYPE_TXTBOX, null, true, 10);

        $this->initVar('cd', XOBJ_DTYPE_TXTBOX, null, true, 10);

        $this->initVar('cd_prnt', XOBJ_DTYPE_TXTBOX, null, false, 10);

        $this->initVar('cd_value', XOBJ_DTYPE_TXTBOX, null, true, 50);

        $this->initVar('cd_desc', XOBJ_DTYPE_TXTAREA, null, false, 255);

        $this->initVar('cd_param', XOBJ_DTYPE_TXTAREA, null, false, 255);

        parent::__construct(); //call the parent constructor.  This ensures that the row_flag properties
        // are in the correct sequence in the variable array
        $this->initVar('_kidsint', XOBJ_DTYPE_OTHER, null); //internal codes of child codes
        $this->initVar('_kidscode', XOBJ_DTYPE_OTHER, null); //user representation of child codes
        $this->initVar('_cd_type', XOBJ_DTYPE_OTHER, null); //code data type
        $this->initVar('_cd_len', XOBJ_DTYPE_OTHER, null); //code data lenth
        $this->initVar('_val_type', XOBJ_DTYPE_OTHER, null); //value data type
        $this->initVar('_val_len', XOBJ_DTYPE_OTHER, null); //value data length
    }

    // end constructor

    /**
     * Function: Overide of ancestor getVar
     *
     * Checks for cd and cd_value and converts to correct data type
     *
     * @param string $key    key of objects variable to be retrieved
     * @param string $format format to use for the output (see XoopsObject::getVar for details)
     *
     * @return mixed formatted value of variable
     * @version 1
     *
     */

    public function getVar($key, $format = 's')
    {
        switch ($key) {
            case 'cd':
                $cd     = parent::getVar('cd');
                $cd_len = parent::getVar('_cd_len');
                switch (parent::getVar('_cd_type')) {
                    case CDM_OBJTYPE_INT:
                    case CDM_OBJTYPE_BIG:
                        $cd = (int)$cd;
                        break;
                    case CDM_OBJTYPE_CHR:
                        $cd = (string)$cd;
                        $cd = str_pad(mb_substr($cd, 0, $cd_len), $cd_len);
                        break;
                    case CDM_OBJTYPE_VAR:
                        $cd = (string)$cd;
                        $cd = mb_substr($cd, 0, $cd_len);
                        break;
                    default:
                        return false;
                }
                //end switch
                $this->setVar('cd', $cd); //return the value to variable
                break;
            case 'cd_value':
                $cd_val = parent::getVar('cd_value');
                $cd_len = parent::getVar('_val_len');
                switch (parent::getVar('_val_type')) {
                    case CDM_OBJTYPE_INT:
                    case CDM_OBJTYPE_BIG:
                        $cd_val = (int)$cd_val;
                        break;
                    case CDM_OBJTYPE_CHR:
                        $cd_val = (string)$cd_val;
                        $cd_val = str_pad(mb_substr($cd_val, 0, $cd_len), $cd_len);
                        break;
                    case CDM_OBJTYPE_VAR:
                        $cd_val = (string)$cd_val;
                        $cd_val = mb_substr($cd_val, 0, $cd_len);
                        break;
                    default:
                        return false;
                }
                //end switch
                $this->setVar('cd_value', $cd_val); //return the value to variable
                break;
            default:
                break;
        }

        //end switch

        $ret = parent::getVar($key, $format);

        return $ret;
    }

    //end function

    /**
     * Returns child codes (kids) as a comma seperated string list of internal identifiers
     *
     * @return string
     */

    public function get_kidsinternal()
    {
        $kids = $this->getVar('_kidsint');

        $kidstr = '';

        foreach ($kids as $kid) {
            $kidstr .= $kid . ',';
        }

        return rtrim($kidstr, ',');
    }

    //end function

    /**
     * Returns child codes (kids) as a comma seperated string list of codes
     *
     * @return string
     */

    public function get_kidscodes()
    {
        $kids = $this->getVar('_kidscode');

        $kidstr = '';

        foreach ($kids as $kid) {
            $kidstr .= $kid . ',';
        }

        return rtrim($kidstr, ',');
    }

    //end function

    /**
     * Return an html string of the list of child codes with
     * hyperlinks to edit the child code.
     *
     * Codes are displayed in rows of 5 codes per line
     *
     * @return string html string
     */

    public function getKidsHtml()
    {
        $kids = $this->getVar('_kidsint');

        $codes = $this->getVar('_kidscode');

        $count = 0;

        $brk = 0;

        $str = '';

        foreach ($kids as $kid) {
            $str .= "<a href='cdm_codes_edit.php?id=" . $kid . "'>" . $codes[$count] . '</a>,';

            $count++;

            $brk++;

            if (4 == $brk) {
                $str .= '<br>';

                $brk = 0;
            }
        }

        return rtrim($str, ',');
    }
    //end function
} // end class Code
