<?php declare(strict_types=1);

namespace XoopsModules\Xbscdm;

//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <https://xoops.org>                             //
//  ------------------------------------------------------------------------ //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //
// Author:    Ashley Kitson                                                  //
// Copyright: (c) 2004, Ashley Kitson
// URL:       http://xoobs.net                                               //
// Project:   The XOOPS Project (https://xoops.org/)                      //
// Module:    Code Data Management (CDM)                                     //
// ------------------------------------------------------------------------- //
/**
 * Base classes used by Code Data Management system
 *
 * @package       CDM
 * @subpackage    CDMBase
 * @author        Ashley Kitson http://xoobs.net
 * @copyright (c) 2004 Ashley Kitson, Great Britain
 */

/**
 * Require Xoops kernel objects so we can extend them
 */
require_once XOOPS_ROOT_PATH . '/kernel/object.php';

/**
 * Meta Object
 *
 * Organises meta data information for a code set.  To instantiate this object use:
 * <code>
 * $metaHandler = xoops_getModuleHandler("Meta",CDM_DIR);
 * $metaData =& $metaHandler->get($id); //where $id is the meta set name
 * </code>
 *
 * @package    CDM
 * @subpackage Meta
 */
class Meta extends BaseObject
{
    /**
     * Constructor
     *
     * The following variables are instantiated for access via ->getVar()
     * <code>
     * $this->initVar('cd_set',XOBJ_DTYPE_TXTBOX,null,10);
     * $this->initVar('cd_type',XOBJ_DTYPE_OTHER,null);
     * $this->initVar('cd_len',XOBJ_DTYPE_INT,null);
     * $this->initVar('val_type',XOBJ_DTYPE_OTHER,null);
     * $this->initVar('val_len',XOBJ_DTYPE_INT,null);
     * $this->initVar('cd_desc',XOBJ_DTYPE_TXTAREA,null);
     * </code>
     */

    public function __construct()
    {
        /* Set up variables to hold information about this code set
         */

        $this->initVar('cd_set', XOBJ_DTYPE_TXTBOX, null, 10);

        $this->initVar('cd_type', XOBJ_DTYPE_OTHER, null);

        $this->initVar('cd_len', XOBJ_DTYPE_INT, null);

        $this->initVar('val_type', XOBJ_DTYPE_OTHER, null);

        $this->initVar('val_len', XOBJ_DTYPE_INT, null);

        $this->initVar('cd_desc', XOBJ_DTYPE_TXTAREA, null);

        parent::__construct(); //call the parent constructor.  This ensures that the row_flag properties
        // are in the correct sequence in the variable array
    }
    //end of function Meta
} //end of class Meta
