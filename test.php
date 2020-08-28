<?php declare(strict_types=1);

/**
 * MUST include module page header
 */
require('header.php');

/**
 * include the main header file
 */
require XOOPS_ROOT_PATH . '/header.php';

include CDM_PATH . '/include/functions.php';

$a = CDMGetCode('LANGUAGE', 'EN');
print $a;
