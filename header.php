<?php declare(strict_types=1);

/**
 * Module header file required by xoops
 *
 * Every CDM file will include this header file.
 *
 * @author        Ashley Kitson http://xoobs.net
 * @copyright (c) 2004, Ashley Kitson
 * @package       CDM
 * @subpackage    Xoops
 * @access        private
 */

/**
 * Xoops required include
 */
require dirname(dirname(__DIR__)) . '/mainfile.php';

/**
 * If you want to use CDM in your own application, you must include defines.php in your own module header file
 */
require XOOPS_ROOT_PATH . '/modules/xbscdm/include/defines.php';
