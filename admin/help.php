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
 * @subpackage    Help
 * @version       1
 * @access        private
 */

/**
 * Do all the declarations etc needed by an admin page
 */
require_once __DIR__ . '/admin_header.php';
require_once __DIR__ . '/adminheader.php';

//Display the admin menu
//xoops_module_admin_menu(0, '');

//xoops_cp_header();

/**
 * To use this as a template you need to write code to display
 * whatever it is you want displaying between here...
 */
require dirname(__DIR__) . '/docu/cdmhelp.html';
//require dirname(__DIR__) . '/docs/CDM/cdmhelp.html';
/**
 * and here.
 */

//And put footer in
xoops_cp_footer();
