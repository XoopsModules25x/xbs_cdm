<?php declare(strict_types=1);

namespace XoopsModules\Xbscdm;

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
 * Base classes used by Code Data Management system
 *
 * @package       CDM
 * @subpackage    CDMBase
 * @copyright (c) 2004, Ashley Kitson
 * @copyright     XOOPS Project https://xoops.org/
 * @license       GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @author        Ashley Kitson http://akitson.bbcb.co.uk
 * @author        XOOPS Development Team
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
