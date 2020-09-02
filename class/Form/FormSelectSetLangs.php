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
 * Create a selection list of available languages for a code set
 *
 * @package    CDM
 * @subpackage Form_Handling
 */
class FormSelectSetLangs extends \XoopsFormSelect
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

        $setHandler = \XoopsModules\Xbscdm\Helper::getInstance()->getHandler('Set');

        $opts = $setHandler->getAvailLanguage($set);

        $this->addOptionArray($opts);

        $this->setValue($lang);
    }
}
