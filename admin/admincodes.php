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
 * Code Admin page
 *
 * Allow administrator to create or modify code data
 *
 * @copyright (c) 2004, Ashley Kitson
 * @copyright     XOOPS Project https://xoops.org/
 * @license       GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @author        Ashley Kitson http://akitson.bbcb.co.uk
 * @author        XOOPS Development Team
 * @package       CDM
 * @subpackage    Admin
 * @version       1
 * @access        private
 */

/**
 * Do all the declarations etc needed by an admin page
 */

use XoopsModules\Xbscdm\Utility;

require_once __DIR__ . '/admin_header.php';
//require_once __DIR__ . '/adminheader.php';
//Display the admin menu
//xoops_module_admin_menu(2, _AM_XBSCDM_ADMENU2);

/**
 * To use this as a template you need to write code to display
 * whatever it is you want displaying between here...
 */

/**
 * @global array Form Post variables
 */
global $_POST;
/**
 * @global array Get variables
 */
global $_GET;
/**
 * @global array User Session variables
 */
global $_SESSION;

extract($_POST);
if (isset($go)) { //edit the Code's record
    $_SESSION['cd_set'] = $cd_set; //save the code data for later user
    $_SESSION['cd']     = $cd;

    $_SESSION['cd_lang'] = $cd_lang;

    Utility::adminEditCode($cd_set, $cd, $cd_lang);
} elseif (isset($insert)) { //create a new code
    $_SESSION['cd_set']  = $cd_set; //save the code data for later user
    $_SESSION['cd_lang'] = $cd_lang;

    Utility::adminEditCode($cd_set, null, $cd_lang);
} elseif (isset($save)) { //user has edited or created a code so save it
    $_SESSION['cd_set'] = $cd_set; //save the code data for later user
    $_SESSION['cd']     = $cd;

    $_SESSION['cd_lang'] = $cd_lang;

    Utility::adminEditCode($cd_set, $cd, $cd_lang, true);
} elseif (isset($cancel)) {
    redirect_header(CDM_URL . '/admin/admincodes.php?gsubmit=1', 1, _AM_XBSCDM_CODED101);
} elseif (isset($submit)) { //user has selected codeset & lang so allow choice of code to edit
    $_SESSION['cd_set']  = $cd_set; //save the code data for later user
    $_SESSION['cd_lang'] = $cd_lang;

    Utility::adminSelectCode($cd_set, $cd_lang);
} else {
    extract($_GET);

    if (isset($gsubmit)) { //user has just commited or cancelled a record save so allow them to choos e a new code to edit
        extract($_SESSION);

        Utility::adminSelectCode($cd_set, $cd_lang);
    } else { //Present a list of code sets to select to work with
        Utility::adminSelectCode();
    }
} //end if

/**
 * and here.
 */

//And put footer in
require_once __DIR__ . '/admin_footer.php';
