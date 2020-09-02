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
 * Xoops module Installation parameters
 *
 * This file conforms to the Xoops standard for the xoops_version.php file.
 * Constant declarations beginning _MI_ are contained in language/../modinfo.php
 *
 * @copyright (c) 2004, Ashley Kitson
 * @copyright     XOOPS Project https://xoops.org/
 * @license       GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @author        Ashley Kitson http://akitson.bbcb.co.uk
 * @author        XOOPS Development Team
 * @package       CDM
 * @version       1.5
 * @subpackage    Installation
 * @access        private
 * @global array Module Installation array as per Xoops
 */

global $modversion;

$moduleDirName      = basename(__DIR__);
$moduleDirNameUpper = mb_strtoupper($moduleDirName);

// ------------------- Informations ------------------- //
$modversion = [
    'version'             => 2.01,
    'module_status'       => 'Beta 1',
    'release_date'        => '2020/09/01',
    'name'                => _MI_XBSCDM_NAME,
    'description'         => _MI_XBSCDM_DESC,
    'official'            => 0,
    //1 indicates official XOOPS module supported by XOOPS Dev Team, 0 means 3rd party supported
    'author'              => 'Ashley Kitson',
    'credits'             => 'XOOPS Development Team',
    'author_mail'         => 'author-email',
    'author_website_url'  => 'https://xoops.org',
    'author_website_name' => 'XOOPS',
    'license'             => 'GPL 2.0 or later',
    'license_url'         => 'www.gnu.org/licenses/gpl-2.0.html/',
    //    'help'                => 'page=help',
    // ------------------- Folders & Files -------------------
    'release_info'        => 'Changelog',
    'release_file'        => XOOPS_URL . "/modules/$moduleDirName/docs/changelog.txt",
    'manual'              => 'link to manual file',
    'manual_file'         => XOOPS_URL . "/modules/$moduleDirName/docs/install.txt",
    // images
    'image'               => 'assets/images/logoModule.png',
    'iconsmall'           => 'assets/images/iconsmall.png',
    'iconbig'             => 'assets/images/iconbig.png',
    'dirname'             => $moduleDirName,
    // Local path icons
    'modicons16'          => 'assets/images/icons/16',
    'modicons32'          => 'assets/images/icons/32',
    //About
    'demo_site_url'       => 'https://xoops.org',
    'demo_site_name'      => 'XOOPS Demo Site',
    'support_url'         => 'https://xoops.org/modules/newbb/viewforum.php?forum=28/',
    'support_name'        => 'Support Forum',
    'submit_bug'          => 'https://github.com/XoopsModules25x/' . $moduleDirName . '/issues',
    'module_website_url'  => 'www.xoops.org',
    'module_website_name' => 'XOOPS Project',
    // ------------------- Min Requirements -------------------
    'min_php'             => '7.1',
    'min_xoops'           => '2.5.10',
    'min_admin'           => '1.2',
    'min_db'              => ['mysql' => '5.5'],
    // ------------------- Admin Menu -------------------
    'system_menu'         => 1,
    'hasAdmin'            => 1,
    'adminindex'          => 'admin/index.php',
    'adminmenu'           => 'admin/menu.php',
    // ------------------- Main Menu -------------------
    'hasMain'             => 1,
    'sub'                 => [
        [
            'name' => _MI_XBSCDM_SMNAME1,
            'url'  => 'cdm_codes_list.php',
        ],
    ],
    // ------------------- Install/Update -------------------
    'onInstall'           => 'include/oninstall.php',
    'onUpdate'            => 'include/onupdate.php',
    //  'onUninstall'         => 'include/onuninstall.php',
    // -------------------  PayPal ---------------------------
    'paypal'              => [
        'business'      => 'xoopsfoundation@gmail.com',
        'item_name'     => 'Donation : ' . _MI_XBSCDM_NAME,
        'amount'        => 0,
        'currency_code' => 'USD',
    ],
    // ------------------- Search ---------------------------
    'hasSearch'           => 0,
    // ------------------- Comments -------------------------
    'hasComments'         => 0,
    // ------------------- Notification ----------------------
    'hasNotification'     => 0,
    // ------------------- Mysql -----------------------------
    'sqlfile'             => ['mysql' => 'sql/mysql.sql'],
    // ------------------- Tables ----------------------------
    'tables'              => [
        $moduleDirName . '_' . 'code',
        $moduleDirName . '_' . 'list',
        $moduleDirName . '_' . 'meta',
    ],
];

// ------------------- Help files ------------------- //
$modversion['help']        = 'page=help';
$modversion['helpsection'] = [
    ['name' => _MI_XBSCDM_OVERVIEW, 'link' => 'page=help'],
    ['name' => _MI_XBSCDM_DISCLAIMER, 'link' => 'page=disclaimer'],
    ['name' => _MI_XBSCDM_LICENSE, 'link' => 'page=license'],
    ['name' => _MI_XBSCDM_SUPPORT, 'link' => 'page=support'],
];

// Main Menu
$modversion['hasMain']        = 1;
$modversion['sub'][0]['name'] = _MI_XBSCDM_SMNAME1;
$modversion['sub'][0]['url']  = 'cdm_codes_list.php';

// Templates

$modversion['templates'] = [
    ['file' => 'xbscdm_list_codes.tpl', 'description' => 'Simple list of codes'],
    ['file' => 'xbscdm_index.tpl', 'description' => 'Select and edit set of codes'],
    //['file' =>  'xbscdm_meta_edit.tpl','description' =>  'Edit a meta record'],
    //['file' =>  'xbscdm_codes_edit.tpl','description' =>  'Edit a code record'],
    //['file' =>  'xbscdm_db_update.tpl','description' =>  'Edit a code record'],
];

// CDM Configuration items

$modversion['config'][] = [
    'name'        => 'def_lang',
    'title'       => '_MI_XBSCDM_DEFLANGNAME',
    'description' => '_MI_XBSCDM_DEFLANGNAMEDESC',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'default'     => 'EN',
    'options'     => [
        'AF - Afrikaans'                      => 'AF',
        'AR - Arabic (Base)'                  => 'AR',
        'ARAE - Arabic (UAE)'                 => 'ARAE',
        'ARBH - Arabic (Bahrain)'             => 'ARBH',
        'ARDZ - Arabic (Algeria)'             => 'ARDZ',
        'AREG - Arabic (Egypt)'               => 'AREG',
        'ARIQ - Arabic (Iraq)'                => 'ARIQ',
        'ARJO - Arabic (Jordan)'              => 'ARJO',
        'ARKW - Arabic (Kuwait)'              => 'ARKW',
        'ARLB - Arabic (Lebanon)'             => 'ARLB',
        'ARLY - Arabic (Libya)'               => 'ARLY',
        'ARMA - Arabic (Morocco)'             => 'ARMA',
        'AROM - Arabic (Oman)'                => 'AROM',
        'ARQA - Arabic (Qatar)'               => 'ARQA',
        'ARSA - Arabic (Saudi Arabia)'        => 'ARSA',
        'ARSY - Arabic (Syria)'               => 'ARSY',
        'ARTN - Arabic (Tunisia)'             => 'ARTN',
        'ARYE - Arabic (Yemen)'               => 'ARYE',
        'BE - Belarussian'                    => 'BE',
        'BG - Bulgarian'                      => 'BG',
        'CA - Catalan'                        => 'CA',
        'CS - Czech'                          => 'CS',
        'DA - Danish'                         => 'DA',
        'DE - German (Germany)'               => 'DE',
        'DEAT - German (Austria)'             => 'DEAT',
        'DECH - German (Switzerland)'         => 'DECH',
        'DELI - German (Leichtenstein)'       => 'DELI',
        'DELU - German (Luxembourgh)'         => 'DELU',
        'EL - Greek'                          => 'EL',
        'EN - English (Base)'                 => 'EN',
        'ENAU - English (Australian)'         => 'ENAU',
        'ENBZ - English (Belize)'             => 'ENBZ',
        'ENCA - English (Canadian)'           => 'ENCA',
        'ENGB - English (United Kingdom)'     => 'ENGB',
        'ENIE - English (Ireland)'            => 'ENIE',
        'ENJM - English (Jamaica)'            => 'ENJM',
        'ENKY - English (Caribbean)'          => 'ENKY',
        'ENNZ - English (New Zealand)'        => 'ENNZ',
        'ENTT - English (Trinidad)'           => 'ENTT',
        'ENUS - English (American)'           => 'ENUS',
        'ENZA - English (South Africa)'       => 'ENZA',
        'ES - Spanish (Modern)'               => 'ES',
        'ESAR - Spanish (Argentina)'          => 'ESAR',
        'ESBO - Spanish (Bolivia)'            => 'ESBO',
        'ESCL - Spanish (Chile)'              => 'ESCL',
        'ESCO - Spanish (Colombia)'           => 'ESCO',
        'ESCR - Spanish (Costa Rica)'         => 'ESCR',
        'ESDO - Spanish (Dominican Republic)' => 'ESDO',
        'ESEC - Spanish (Ecuador)'            => 'ESEC',
        'ESGT - Spanish (Guatemala)'          => 'ESGT',
        'ESHN - Spanish (Honduras)'           => 'ESHN',
        'ESMX - Spanish (Mexico)'             => 'ESMX',
        'ESNI - Spanish (Nicaragua)'          => 'ESNI',
        'ESPA - Spanish (Panama)'             => 'ESPA',
        'ESPE - Spanish (Peru)'               => 'ESPE',
        'ESPR - Spanish (Puerto Rico)'        => 'ESPR',
        'ESPY - Spanish (Paraguay)'           => 'ESPY',
        'ESSV - Spanish (El Salvador)'        => 'ESSV',
        'ESUY - Spanish (Uruguay)'            => 'ESUY',
        'ESVE - Spanish (Venezuela)'          => 'ESVE',
        'ET - Estonian'                       => 'ET',
        'EU - Basque'                         => 'EU',
        'FA - Farsi'                          => 'FA',
        'FI - Finnish'                        => 'FI',
        'FO - Faroese'                        => 'FO',
        'FR - French (France)'                => 'FR',
        'FRBE - French (Belgium)'             => 'FRBE',
        'FRCA - French (Canada)'              => 'FRCA',
        'FRCH - French (Switzerland)'         => 'FRCH',
        'FRLU - French (Luxembourgh)'         => 'FRLU',
        'GD - Gaelic (Scots)'                 => 'GD',
        'HE - Hebrew'                         => 'HE',
        'HI - Hindi'                          => 'HI',
        'HR - Croatian'                       => 'HR',
        'HU - Hungarian'                      => 'HU',
        'IN - Indonesian'                     => 'IN',
        'IS - Icelandic'                      => 'IS',
        'IT - Italian (Italy)'                => 'IT',
        'ITCH - Italian (Switzerland)'        => 'ITCH',
        'JA - Japanese'                       => 'JA',
        'JI - Yiddish'                        => 'JI',
        'KO - Korean (Extended Wansung)'      => 'KO',
        'LT - Lithuanian'                     => 'LT',
        'LV - Lettish'                        => 'LV',
        'MK - Macedonian'                     => 'MK',
        'MS - Malay (Malaysia)'               => 'MS',
        'MT - Maltese'                        => 'MT',
        'NL - Dutch (Nederland)'              => 'NL',
        'NLBE - Dutch (Belgium)'              => 'NLBE',
        'NO - Norwegian (Bokmal)'             => 'NO',
        'PL - Polish'                         => 'PL',
        'PT - Portuguese'                     => 'PT',
        'PTBR - Portuguese (Brazil)'          => 'PTBR',
        'RM - Rhaeto-Romance'                 => 'RM',
        'RO - Romanian'                       => 'RO',
        'ROMO - Romanian (Moldova)'           => 'ROMO',
        'RU - Russian'                        => 'RU',
        'RUMO - Russian (Moldova)'            => 'RUMO',
        'SK - Slovak'                         => 'SK',
        'SL - Slovenian'                      => 'SL',
        'SQ - Albanian'                       => 'SQ',
        'SR - Serbian (Cyrillic)'             => 'SR',
        'SV - Swedish'                        => 'SV',
        'SVFI - Swedish (Finland)'            => 'SVFI',
        'SX - Sutu'                           => 'SX',
        'TH - Thai'                           => 'TH',
        'TN - Setsuana'                       => 'TN',
        'TR - Turkish'                        => 'TR',
        'TS - Tsonga'                         => 'TS',
        'UK - Ukrainian'                      => 'UK',
        'UR - Urdu (Pakistan)'                => 'UR',
        'VI - Vietnamese'                     => 'VI',
        'XH - Xhosa'                          => 'XH',
        'ZH - Chinese (Base)'                 => 'ZH',
        'ZHCN - Chinese (PRC)'                => 'ZHCN',
        'ZHHK - Chinese (Hong Kong)'          => 'ZHHK',
        'ZHSG - Chinese (Singapore)'          => 'ZHSG',
        'ZHTW - Chinese (Taiwan)'             => 'ZHTW',
        'ZU - Zulu'                           => 'ZU',
    ],
];

$modversion['config'][] = [
    'name'        => 'def_codeset',
    'title'       => '_MI_XBSCDM_DEFCODESETNAME',
    'description' => '_MI_XBSCDM_DEFCODESETNAMEDESC',
    'formtype'    => 'text',
    'valuetype'   => 'text',
    'default'     => 'BASE',
];
// Blocks

$modversion['blocks'][] = [
    'file'        => 'cdm_block_codelookup.php',
    'name'        => _MI_XBSCDM_BLOCK_CODELOOKUPNAME,
    'description' => _MI_XBSCDM_BLOCK_CODELOOKUPDESC,
    'show_func'   => 'b_cdm_codelookup_show',
    'edit_func'   => 'b_cdm_codelookup_edit',
    'options'     => 'COUNTRY|EN    |0|0', //Setname | Language | Allow set change | Allow language change
    'template'    => 'cdm_block_codelookup.tpl',
];
