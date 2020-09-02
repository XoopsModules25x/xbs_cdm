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
 * Set object
 *
 * Holds information about a complete code set. To instantiate this object use:
 * <code>
 * $setHandler = xoops_getModuleHandler("Set",CDM_DIR);
 * $setData =& $setHandler->get($id); //where $id is the meta set name
 * </code>
 *
 * There is no insert() method for this object.  This is therefore a read-only object.
 * To write a meta set or code back to the database use the Meta and Code object methods.
 *
 * @package    CDM
 * @subpackage Set
 */
class Set extends BaseObject
{
    /**
     * Constructor
     *
     * The following variables are instantiated for access via ->getVar()
     * <code>
     * $this->initVar('meta',XOBJ_DTYPE_OTHER,null);
     * $this->initVar('code',XOBJ_DTYPE_OTHER,null);
     * </code>
     * The 'code' variable is an array of code objects
     */

    public function __construct()
    {
        /** Set up variables to hold information about this code set
         */

        $this->initVar('meta', XOBJ_DTYPE_OTHER, null);

        $this->initVar('code', XOBJ_DTYPE_OTHER, null);

        $v = [];

        $this->assignVar('code', $v);
    }

    //end of function Set

    /**
     * Function getMeta() Get the meta data for the set as a Meta object
     *
     * @return void Object
     */

    public function getMeta()
    {
        return $this->getVar('meta');
    }

    //end function getMeta

    /** Function getMetaData()  return the meta object data as associative array
     *
     * @return associative array of values
     */

    public function getMetaData()
    {
        $meta = $this->getVar('meta');

        if ($meta->cleanVars()) {
            return $meta->cleanVars;
        }

        return false;
        //end if
    }

    //end function getMetaData

    /**
     * Function getCodes()  get the set of codes as an enumerated array of Code objects
     *
     * @return void of Code objects
     */

    public function getCodes()
    {
        return $this->getVar('code');
    }

    //end function getCodes

    /**
     * Function getCodeEnum($enum) get the code identified by its array index
     *
     * @parameter $enum  position in the array of codes
     * @param $enum
     * @return Code object else FALSE
     */

    public function getCodeEnum($enum)
    {
        $codeList = $this->getCodes();

        return $codeList[$enum];
    }

    //end function getCodeEnum

    /**
     * Function getAbrevCodeList()
     * Returns the set of codes as a id, code, code_value, code_description, row_flag array
     * usually to be used in a drop down list box on a form or similar
     *
     * @return array Indexed array of associative arrays containing abbreviated code list $ret[0..n]= array("id"=>,"cd"=>,"cd_value"=>, "cd_desc"=>)
     */

    public function getAbrevCodeList()
    {
        $codeList = $this->getCodes();

        $ret = [];

        foreach ($codeList as $c) {
            $ret[] = [
                'id'       => $c->getVar('id'),
                'cd'       => $c->getVar('cd'),
                'cd_value' => $c->getVar('cd_value'),
                'cd_desc'  => $c->getVar('cd_desc'),
                'row_flag' => $c->getVar('row_flag'),
            ];
        }

        //end foreach

        return $ret;
    }

    //end function getAbrevCodeList

    /**
     * Function getFullCodeList
     *
     * @return array The full data set for every code in the set in form of indexed array of associative arrays; $ret[0..n] = array();
     */

    public function getFullCodeList()
    {
        $codeList = $this->getCodes();

        $ret = [];

        foreach ($codeList as $v) {
            $v->cleanVars();

            $ret[] = $v->cleanVars;
        }

        //end foreach

        return $ret;
    }

    //end function getFullCodeList

    /**
     * Function getCodeTree
     *
     * Creates a XoopsObjectTree object of a hierarchical code set
     *
     * @return \XoopsModules\Xbscdm\Tree
     */

    public function getTree()
    {
        return new Tree($this->getCodes(), 'cd', 'cd_prnt', 0);
    }

    //end function getTree

    /**
     * Function getSelTreeList
     *
     * @param string $dispFld name of field to use for displaying select option
     * @param string $prefix  character used to indent tree hiearchy
     *
     * Creates and returns an array of the code set in tree order
     * suitable for putting into a selection box
     * @return array
     */

    public function getSelTreeList($dispFld = 'cd_value', $prefix = '-')
    {
        $tree = $this->getTree();

        return $tree->getSelArr($dispFld, $prefix);
    }
    //end function
} //end of class Set
