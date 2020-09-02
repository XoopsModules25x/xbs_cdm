<?php declare(strict_types=1);

use XoopsModules\Xbscdm;

/*
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * Code Lookup Block show and edit functions
 *
 * @copyright (c) 2004, Ashley Kitson
 * @copyright     XOOPS Project https://xoops.org/
 * @license       GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @author        Ashley Kitson http://akitson.bbcb.co.uk
 * @author        XOOPS Development Team
 * @package       CDM
 * @subpackage    Blocks
 * @version       1
 * @access        private
 */

//avoid declaring the functions repeatedly
if (defined('CDM_BLOOKUP_DEFINED')) {
    return;
}
/**
 * Flag to tell script it is already parsed.  If set then script is exited
 */
define('CDM_BLOOKUP_DEFINED', true);

/**
 * CDM constant definitions
 */
require_once XOOPS_ROOT_PATH . '/modules/xbscdm/include/defines.php';

/**
 * Function: Create display data for block
 *
 * Retrieve block configuration data and format block output
 *
 * @param array $options block config options
 *                       [0] = Set Name
 *                       [1] = Language Code
 *                       [2] = Allow set change
 *                       [3] = Allow language change
 *
 * @return array output parameters for smarty template
 * @version 1
 *
 */
function b_cdm_codelookup_show($options)
{
    //see if user has changed the set or language to display

    global $_SESSION;

    $setName = $_SESSION['cdm_blookup_set'] ?? $options[0];

    $langName = $_SESSION['cdm_blookup_lang'] ?? $options[1];

    $setChange = (isset($options[2]) ? 1 == $options[2] : 0);

    $langChange = (isset($options[3]) ? 1 == $options[3] : 0);

    $block = [];

    //Form action

    $block['action'] = CDM_URL . '/changevars.php';

    //set of codes for display

    $fset = new Xbscdm\Form\FormSelect($setName, '', 'cd', null, 1, $langName);

    $fset->setExtra('onChange = "showCode()"');

    $block['codeset'] = $fset->render();

    $block['codesetname'] = $setName;

    $block['defcdval'] = _MB_XBSCDM_BLOOK_DEFCDVAL;

    if ($setChange) {
        $setChoice = new Xbscdm\Form\FormSelectSet('', 'cd_set');

        $setChoice->setValue($setName);

        $block['setchange'] = $setChoice->render();

        $block['setchangename'] = _MB_XBSCDM_BLOOK_SETCHOICE;
    }

    //language change ability

    if ($langChange) {
        $langChoice = new Xbscdm\Form\FormSelectSetLangs($setName, '', 'cd_lang');

        $block['langchange'] = $langChoice->render();

        $block['langchangename'] = _MB_XBSCDM_BLOOK_LANGCHOICE;
    }

    //button if required

    if ($setChange || $langChange) {
        $submit = new \XoopsFormButton('', 'submit', _MB_XBSCDM_BLOOK_SUBMIT, 'submit');

        $block['submit'] = $submit->render();
    }

    //set up the javascript for the form

    $js = 'function showCode() {
        document.lookup_form.cvalue.value = document.lookup_form.cd.value;
    }';

    $block['javascript'] = $js;

    return $block;
}

/**
 * Function: Create additional data items for block admin edit form
 *
 * Format a mini table for block options to be included in the
 * main block admin edit form.  All data field names must be 'options[]'
 * and declared in the form in the order of the parameter to this function.
 *
 * @param array $options block config options
 *                       [0] = Set Name
 *                       [1] = Language Code
 *                       [2] = Allow set change
 *                       [3] = Allow language change
 *
 * @return string Output html for smarty template
 * @version 1
 *
 */
function b_cdm_codelookup_edit($options)
{
    /*create input fields using XoopsForm objects
       * It is clearer to use XoopsForm object->render() to create the form elements
    * rather than hand coding the html.
    */

    $fld = [];

    $s = new Xbscdm\Form\FormSelectSet('', 'options[]');

    $s->setValue($options[0]);

    $fld[0] = $s->render();

    unset($s);

    $s = new Xbscdm\Form\FormSelectLanguage('', 'options[]');

    $s->setValue($options[1]);

    $fld[1] = $s->render();

    unset($s);

    if (!isset($options[2])) {
        $options[2] = 0;
    }

    $s = new \XoopsFormCheckBox('', 'options[]', $options[2]);

    $s->addOption('1', 'Yes');

    $fld[2] = $s->render();

    unset($s);

    if (!isset($options[3])) {
        $options[3] = 0;
    }

    $s = new \XoopsFormCheckBox('', 'options[]', $options[3]);

    $s->addOption('1', 'Yes');

    $fld[3] = $s->render();

    unset($s);

    //construct the table that will be placed into the admin form

    $form = '<table>';

    $form .= '<tr><td>' . _MB_XBSCDM_BLOOK_SETCHOICE . '</td><td>' . $fld[0] . '</td></tr>';

    $form .= '<tr><td>' . _MB_XBSCDM_BLOOK_LANGCHOICE . '</td><td>' . $fld[1] . '</td></tr>';

    $form .= '<tr><td>' . _MB_XBSCDM_BLOOK_ALLOWSETCHANGE . '</td><td>' . $fld[2] . '</td></tr>';

    $form .= '<tr><td>' . _MB_XBSCDM_BLOOK_ALLOWLANGCHANGE . '</td><td>' . $fld[3] . '</td></tr>';

    $form .= '</table>';

    return $form;
}
