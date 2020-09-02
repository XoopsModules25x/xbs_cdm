<?php declare(strict_types=1);

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
 * Change the set and language choices for code lookup block
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

/**
 * Xoops mainfile
 */

use Xmf\Request;

include_once('../../../mainfile.php');
/**
 * Xoops header
 */
include_once('../../../header.php');

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
