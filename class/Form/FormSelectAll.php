<?php declare(strict_types=1);

namespace XoopsModules\Xbscdm\Form;

/*
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

// $Id: cdmformselectcountry.php,v 1.0 2004/11/02 01:24:08 akitson Exp $

/**
 * Classes used by Code Data Management system to present form data
 *
 * @package       CDM
 * @subpackage    Form_Handling
 * @copyright (c) 2004, Ashley Kitson
 * @copyright     XOOPS Project https://xoops.org/
 * @license       GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @author        Ashley Kitson http://akitson.bbcb.co.uk
 * @author        XOOPS Development Team
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
 * Returns all codes (even defunct ones). Suffixes Suspended and Defunct codes
 *
 * @package    CDM
 * @subpackage Form_Handling
 */
class FormSelectAll extends \XoopsFormSelect
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

        $setHandler = \XoopsModules\Xbscdm\Helper::getInstance()->getHandler('Set');

        $list_loaded = $setHandler->isListLoaded($setName, $field, true, false, $lang);

        if (!$list_loaded) {
            $set = $setHandler->getAll($setName, null, null, $lang);

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
