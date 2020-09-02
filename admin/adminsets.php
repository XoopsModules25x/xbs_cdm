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
 * Codeset Admin page
 *
 * Allow administrator to create or modify Code Set data
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
//xoops_module_admin_menu(1, _AM_XBSCDM_ADMENU1);

/**
 * To use this as a template you need to write code to display
 * whatever it is you want displaying between here...
 */

/**
 * @global array Form Post variables
 */
global $_POST;
/**
 * @global array User Session variables
 */
global $_SESSION;

extract($_POST);
if (isset($submit)) { //edit the Set's record
    $_SESSION['cd_set'] = $cd_set; //save the code set for later user
    Utility::adminEditSet($cd_set);
} elseif (isset($insert)) { //create a new Set
    Utility::adminEditSet();
} elseif (isset($save)) { //user has edited or created a Set so save it
    $_SESSION['cd_set'] = $cd_set; //save the code set for later user
    Utility::adminEditSet($cd_set, true);
} elseif (isset($cancel)) {
    redirect_header(CDM_URL . '/admin/adminsets.php', 1, _AM_XBSCDM_SETED101);
} else { //Present a list of code sets to select to work with
    Utility::adminSelectSet();
} //end if

/**
 * and here.
 */

//And put footer in
require_once __DIR__ . '/admin_footer.php';
