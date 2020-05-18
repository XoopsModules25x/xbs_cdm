<?php declare(strict_types=1);

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
 * CDM Tree class
 */
require_once CDM_PATH . '/class/CDMTree.php';

/**
 *  Adds row management for all CDM objects
 *
 *  Although the attributes are declared below in this class
 *  the ancestor classes to this will have to deal with them
 *  so this is an abstract class
 *
 * <pre>
 * The following settings of $object->isDirty and $object->isNew
 * may be helpful to users. NB operations may involve using the object handler<br>
 * After Operation   isDirty    isNew       operation returns<br>
 * ----------------- -------    ---------   --------------------------<br>
 * &create           FALSE      TRUE        object or FALSE if failure<br>
 * &get              FALSE      FALSE       TRUE on success else FALSE<br>
 * reload            FALSE      FALSE       TRUE on success else FALSE<br>
 * Data item changed TRUE       Undefined   TRUE on success else FALSE<br>
 * Success insert    FALSE      FALSE       TRUE<br>
 * Fail insert       TRUE       Undefined   FALSE<br>
 * delete            FALSE      FALSE       TRUE on success else FALSE<br>
 * </pre>
 *
 * @package    CDM
 * @subpackage CDMBase
 * @abstract
 */
class CDMBaseObject extends XoopsObject
{
    /**
     * Constructor
     *
     * The following variables  are set for retrieval with ->getVar()
     * <code>
     * $this->initVar('row_flag',XOBJ_DTYPE_OTHER,null,TRUE);
     * $this->initVar('row_uid',XOBJ_DTYPE_INT,null,TRUE);
     * $this->initVar('row_dt',XOBJ_DTYPE_OTHER,null,TRUE);
     * </code>
     */

    public function __construct()
    {
        //NB if we set row_dt as XOBJ_DTYPE_?TIME it will get converted

        // to unix datetime number format which will not work for the

        // timestamp format of the underlying data column type in mysql

        // so we set it to _OTHER so it gets left alone by cleanVars()

        $this->initVar('row_flag', XOBJ_DTYPE_OTHER, null, true);

        $this->initVar('row_uid', XOBJ_DTYPE_INT, null, true);

        $this->initVar('row_dt', XOBJ_DTYPE_OTHER, null, true);

        parent::__construct(); //call ancestor constructor
    }

    /**
     * Defunct the object (permanent measure to deactivate the object)
     *
     * @return bool TRUE if status changed else FALSE
     */

    public function setDefunct()
    {
        $stat = $this->getVar('row_flag');

        if (empty($stat) || CDM_RSTAT_DEF != $stat) {
            $this->setVar('row_flag', CDM_RSTAT_DEF);

            $this->setDirty();

            return true;
        }

        return false;
    }

    /**
     * Suspend the object (usually a temporary measure)
     *
     * @return bool TRUE if status changed else FALSE
     */

    public function setSuspend()
    {
        $stat = $this->getVar('row_flag');

        if (empty($stat) || CDM_RSTAT_ACT == $stat) {
            $this->setVar('row_flag', CDM_RSTAT_SUS);

            $this->setDirty();

            return true;
        }

        return false;
    }

    /**
     * Make the object Active (default for all new objects)
     *
     * @return bool TRUE if status changed else FALSE
     */

    public function setActive()
    {
        $stat = $this->getVar('row_flag');

        if (empty($stat) || CDM_RSTAT_SUS == $stat) {
            $this->setVar('row_flag', CDM_RSTAT_ACT);

            $this->setDirty();

            return true;
        }

        return false;
    }

    /**
     * Return date-time in format for insertion into timestamp field of row_dt
     *
     * @return datatime format = yyyy-mm-dd hh:mm:ss
     */

    public function getCurrentDateTime()
    {
        $dte = getdate();

        return $dte['year'] . '-' . str_pad($dte['mon'], 2, '0', STR_PAD_LEFT) . '-' . str_pad($dte['mday'], 2, '0', STR_PAD_LEFT) . ' ' . str_pad($dte['hours'], 2, '0', STR_PAD_LEFT) . ':' . str_pad($dte['minutes'], 2, '0', STR_PAD_LEFT) . ':' . str_pad($dte['seconds'], 2, '0', STR_PAD_LEFT);
    }

    /**
     * Set the row_edit_dtime value to now
     *
     * @access private
     */

    public function _setRowDate()
    {
        $dte = $this->getCurrentDateTime();

        $this->setVar('row_dt', $dte);
    }

    /**
     * Set the row uid to currently logged on user
     *
     * @access private
     */

    public function _setRowUid()
    {
        /**
         * @global xoopsUser Xoops user object
         */

        global $xoopsUser;

        $uid = $xoopsUser->getVar('uid'); //get id of currently logged on user.  Any write to the

        //database requires that the uid is recorded against

        //the change.

        $this->setVar('row_uid', $uid);
    }

    /**
     * Set the row information prior to an update/insert etc
     */

    public function setRowInfo()
    {
        $this->_setRowDate();

        $this->_setRowUid();
    }
}

//end class CDMBaseObject

/**
 * Code object
 *
 * A code is a single item in a code set.  To instantiate this object use:
 * <code>
 * $codeHandler = xoops_getModuleHandler("CDMCode",CDM_DIR);
 * $codeData =& $codeHandler->get($id); //$id is the required internal id of the code
 * </code>
 *
 * @package    CDM
 * @subpackage CDMCode
 */
class CDMCode extends CDMBaseObject
{
    /**
     * Constructor
     *
     * The following variables are instantiated for access via ->getVar()
     * <code>
     * $this->initVar('id',XOBJ_DTYPE_INT,null,TRUE);
     * $this->initVar('cd_set',XOBJ_DTYPE_TXTBOX,null,TRUE,10);
     * $this->initVar('cd_lang',XOBJ_DTYPE_TXTBOX,null,TRUE,10);
     * $this->initVar('cd',XOBJ_DTYPE_TXTBOX,null,TRUE,10);
     * $this->initVar('cd_prnt',XOBJ_DTYPE_TXTBOX,null,FALSE,10);
     * $this->initVar('cd_value',XOBJ_DTYPE_TXTBOX,null,TRUE,50);
     * $this->initVar('cd_desc',XOBJ_DTYPE_TXTAREA,null,FALSE,255);
     * $this->initVar('cd_param',XOBJ_DTYPE_TXTAREA,null,FALSE,255);
     * $this->initVar('_kidsint',XOBJ_DTYPE_OTHER,null);
     * $this->initVar('_kidscode',XOBJ_DTYPE_OTHER,null);
     * $this->initVar('_cd_type',XOBJ_DTYPE_OTHER,null);//code data type
     * $this->initVar('_cd_len',XOBJ_DTYPE_OTHER,null);//code data lenth
     * $this->initVar('_val_type',XOBJ_DTYPE_OTHER,null);//value data type
     * $this->initVar('_val_len',XOBJ_DTYPE_OTHER,null);//value data length
     * </code>
     */

    public function __construct()
    {
        //constructor
        $this->initVar('id', XOBJ_DTYPE_INT, null, true);

        $this->initVar('cd_set', XOBJ_DTYPE_TXTBOX, null, true, 10);

        $this->initVar('cd_lang', XOBJ_DTYPE_TXTBOX, null, true, 10);

        $this->initVar('cd', XOBJ_DTYPE_TXTBOX, null, true, 10);

        $this->initVar('cd_prnt', XOBJ_DTYPE_TXTBOX, null, false, 10);

        $this->initVar('cd_value', XOBJ_DTYPE_TXTBOX, null, true, 50);

        $this->initVar('cd_desc', XOBJ_DTYPE_TXTAREA, null, false, 255);

        $this->initVar('cd_param', XOBJ_DTYPE_TXTAREA, null, false, 255);

        parent::__construct(); //call the parent constructor.  This ensures that the row_flag properties
        // are in the correct sequence in the variable array
        $this->initVar('_kidsint', XOBJ_DTYPE_OTHER, null); //internal codes of child codes
        $this->initVar('_kidscode', XOBJ_DTYPE_OTHER, null); //user representation of child codes
        $this->initVar('_cd_type', XOBJ_DTYPE_OTHER, null); //code data type
        $this->initVar('_cd_len', XOBJ_DTYPE_OTHER, null); //code data lenth
        $this->initVar('_val_type', XOBJ_DTYPE_OTHER, null); //value data type
        $this->initVar('_val_len', XOBJ_DTYPE_OTHER, null); //value data length
    }

    // end constructor

    /**
     * Function: Overide of ancestor getVar
     *
     * Checks for cd and cd_value and converts to correct data type
     *
     * @param string $key    key of objects variable to be retrieved
     * @param string $format format to use for the output (see XoopsObject::getVar for details)
     *
     * @return mixed formatted value of variable
     * @version 1
     *
     */

    public function getVar($key, $format = 's')
    {
        switch ($key) {
            case 'cd':
                $cd     = parent::getVar('cd');
                $cd_len = parent::getVar('_cd_len');
                switch (parent::getVar('_cd_type')) {
                    case CDM_OBJTYPE_INT:
                    case CDM_OBJTYPE_BIG:
                        $cd = (int)$cd;
                        break;
                    case CDM_OBJTYPE_CHR:
                        $cd = (string)$cd;
                        $cd = str_pad(mb_substr($cd, 0, $cd_len), $cd_len);
                        break;
                    case CDM_OBJTYPE_VAR:
                        $cd = (string)$cd;
                        $cd = mb_substr($cd, 0, $cd_len);
                        break;
                    default:
                        return false;
                }
                //end switch
                $this->setVar('cd', $cd); //return the value to variable
                break;
            case 'cd_value':
                $cd_val = parent::getVar('cd_value');
                $cd_len = parent::getVar('_val_len');
                switch (parent::getVar('_val_type')) {
                    case CDM_OBJTYPE_INT:
                    case CDM_OBJTYPE_BIG:
                        $cd_val = (int)$cd_val;
                        break;
                    case CDM_OBJTYPE_CHR:
                        $cd_val = (string)$cd_val;
                        $cd_val = str_pad(mb_substr($cd_val, 0, $cd_len), $cd_len);
                        break;
                    case CDM_OBJTYPE_VAR:
                        $cd_val = (string)$cd_val;
                        $cd_val = mb_substr($cd_val, 0, $cd_len);
                        break;
                    default:
                        return false;
                }
                //end switch
                $this->setVar('cd_value', $cd_val); //return the value to variable
                break;
            default:
                break;
        }

        //end switch

        $ret = parent::getVar($key, $format);

        return $ret;
    }

    //end function

    /**
     * Returns child codes (kids) as a comma seperated string list of internal identifiers
     *
     * @return string
     */

    public function get_kidsinternal()
    {
        $kids = $this->getVar('_kidsint');

        $kidstr = '';

        foreach ($kids as $kid) {
            $kidstr .= $kid . ',';
        }

        return rtrim($kidstr, ',');
    }

    //end function

    /**
     * Returns child codes (kids) as a comma seperated string list of codes
     *
     * @return string
     */

    public function get_kidscodes()
    {
        $kids = $this->getVar('_kidscode');

        $kidstr = '';

        foreach ($kids as $kid) {
            $kidstr .= $kid . ',';
        }

        return rtrim($kidstr, ',');
    }

    //end function

    /**
     * Return an html string of the list of child codes with
     * hyperlinks to edit the child code.
     *
     * Codes are displayed in rows of 5 codes per line
     *
     * @return string html string
     */

    public function getKidsHtml()
    {
        $kids = $this->getVar('_kidsint');

        $codes = $this->getVar('_kidscode');

        $count = 0;

        $brk = 0;

        $str = '';

        foreach ($kids as $kid) {
            $str .= "<a href='cdm_codes_edit.php?id=" . $kid . "'>" . $codes[$count] . '</a>,';

            $count++;

            $brk++;

            if (4 == $brk) {
                $str .= '<br>';

                $brk = 0;
            }
        }

        return rtrim($str, ',');
    }
    //end function
} // end class CDMCode

/**
 * CDMMeta Object
 *
 * Organises meta data information for a code set.  To instantiate this object use:
 * <code>
 * $metaHandler = xoops_getModuleHandler("CDMMeta",CDM_DIR);
 * $metaData =& $metaHandler->get($id); //where $id is the meta set name
 * </code>
 *
 * @package    CDM
 * @subpackage CDMMeta
 */
class CDMMeta extends CDMBaseObject
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
    //end of function CDMMeta
} //end of class CDMMeta

/**
 * CDMSet object
 *
 * Holds information about a complete code set. To instantiate this object use:
 * <code>
 * $setHandler = xoops_getModuleHandler("CDMSet",CDM_DIR);
 * $setData =& $setHandler->get($id); //where $id is the meta set name
 * </code>
 *
 * There is no insert() method for this object.  This is therefore a read-only object.
 * To write a meta set or code back to the database use the CDMMeta and CDMCode object methods.
 *
 * @package    CDM
 * @subpackage CDMSet
 */
class CDMSet extends CDMBaseObject
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

    //end of function CDMSet

    /**
     * Function getMeta() Get the meta data for the set as a CDMMeta object
     *
     * @return void Object
     */

    public function getMeta()
    {
        return & $this->getVar('meta');
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
     * Function getCodes()  get the set of codes as an enumerated array of CDMCode objects
     *
     * @return void of CDMCode objects
     */

    public function getCodes()
    {
        return & $this->getVar('code');
    }

    //end function getCodes

    /**
     * Function getCodeEnum($enum) get the code identified by its array index
     *
     * @parameter $enum  position in the array of codes
     * @param $enum
     * @return CDMCode object else FALSE
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
     * @return \CDMObjectTree
     */

    public function getTree()
    {
        return new CDMObjectTree($this->getCodes(), 'cd', 'cd_prnt', 0);
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
} //end of class CDMSet

/**
 * Object handler for CDM objects
 *
 * @package    CDM
 * @subpackage CDMBase
 * @abstract
 */
class CDMBaseHandler extends XoopsObjectHandler
{
    // Public Variables
    /**
     * Set in descendent constructor to name of object that this handler handles
     *
     * @var string
     */

    public $classname;
    /**
     * Set in ancestor to name of unique ID generator tag for use with insert function
     *
     * @var string
     */

    public $ins_tagname;
    // Private variables
    /**
     * most recent error number
     *
     * @access private
     * @var int
     */

    public $_errno = 0;
    /**
     * most recent error string
     *
     * @access private
     * @var string
     */

    public $_error = '';

    /**
     * Constructor
     *
     * @param xoopsDatabase &$db handle for xoops database object
     */

    public function __construct(\XoopsDatabase $db)
    {
        parent::__construct($db);
    }

    /**
     * Set error information
     *
     * @param int    $errnum =0 Error number
     * @param string $errstr ='' Error Message
     */

    public function setError($errnum = 0, $errstr = '')
    {
        $this->_errno = $errnum;

        $this->_error = $errstr;
    }

    /**
     * Return last error number
     *
     * @return int
     */

    public function errno()
    {
        return $this->_errno;
    }

    /**
     * Return last error message
     *
     * @return  string
     */

    public function error()
    {
        return $this->_error;
    }

    /**
     * return last error number and message
     *
     * @return string
     */

    public function getError()
    {
        return 'Error No ' . $this->_errno . ' - ' . $this->_error;
    }

    /**
     * Must be overidden in ancestor to return a new object of the required kind (descendent of CDMBase)
     *
     * @abstract
     * @return bool or False if no object created
     */

    public function _create()
    {
        //return new object() - must be descendent of CDMBase

        return false;
    }

    /**
     * Create a new object
     *
     * Relies on _create to create the actual object
     *
     * @param bool $isNew =true create a new object and tell it is new.  If False then create object but set it as not new
     *
     * @return bool descendent of CDMBase else False if failure
     */

    public function create($isNew = true)
    {
        $obj = $this->_create();

        if ($isNew && $obj) { //if it is new and the object was created
            $obj->setNew();

            $obj->unsetDirty();
        } else {
            if ($obj) { //it is not new (forced by caller, usually &getall()) but obj was created
                $obj->unsetNew();

                $obj->unsetDirty();
            } else {
                $this->setError(-1, sprintf(_MD_CDM_ERR_2, $classname));

                return false; //obj was not created so return False to caller.
            }
        }

        return $obj;
    }

    // end create function

    /**
     * Get data from the database and create a new object with it
     *
     * Abstract method. Overide in ancestor and supply the sql string to get the data
     *
     * @abstract
     *
     * @param          $key
     * @param string   $row_flag default null (get all), Option(CDM_RSTAT_ACT, CDM_RSTAT_DEF, CDM_RSTAT_SUS)
     * @param string   $lang     default null (get all), Valid LANGUAGE code.  Will only return object of that language set
     *
     * @return  string SQL string to get data
     */

    public function _get($key, $row_flag, $lang)
    {
        //overide in ancestor and supply the sql string to get the data
        return '';
    }

    /**
     * Get all data for object given id.
     *
     * For safety use the get method which will only return Active rows.
     *
     * @param int    $id       data item internal identifier
     * @param string $row_flag default null (get all), Option(CDM_RSTAT_ACT, CDM_RSTAT_DEF, CDM_RSTAT_SUS)
     * @param string $lang     default null (get all), Valid LANGUAGE code.  Will only return object of that language set
     *
     * @return object descendent of CDMBase
     */

    public function getall($id, $row_flag = null, $lang = null)
    {
        $test = (is_int($id) ? ($id > 0 ? true : false) : !empty($id) ? true : false); //test validity of id

        //    $id = intval($id);

        if ($test) {
            $code = $this->create(false);

            if ($code) {
                $sql = $this->_get($id, $row_flag, $lang);

                if ($result = $this->db->query($sql)) {
                    if (1 == $this->db->getRowsNum($result)) {
                        $code->assignVars($this->db->fetchArray($result));

                        return $code;
                    }

                    $this->setError(-1, sprintf(_MD_CDM_ERR_1, (string)$id));
                } else {
                    $this->setError($this->db->errno(), $this->db->error());
                }
                //end if
            }
            //end if - error value set in call to create()
        } else {
            $this->setError(-1, sprintf(_MD_CDM_ERR_1, (string)$id));
        }

        //end if
        return false; //default return
    }

    //end function &getall

    /**
     * Get safe data from database.
     *
     * This function is the one that should normally be called to set up the object as it will
     * only return active rows and of a language set that must be specified
     *
     * @param int    $id   internal id of the object. Internal code is a unique int value.
     * @param string $lang default CDM_DEF_LANG, Valid LANGUAGE code.  Will only return codes of that language set
     *
     * @return  object Descendent of CDMBase if success else FALSE on failure
     */

    public function get($id, $lang = CDM_DEF_LANG)
    {
        return $this->getall($id, CDM_RSTAT_ACT, $lang);
    }

    /**
     * Get internal identifier (primary key) based on user visible code
     *
     * overide in ancestor to return the identifier
     *
     * @abstract
     *
     * @param mixed Dependednt on descendent class
     *
     * @return object of required type
     */

    public function getKey()
    {
        return null;
    }

    /**
     * Return SQL string to reload an object from database
     *
     * @abstract
     * @param $key
     * @return string
     */

    public function _reload($key)
    {
        //overide in ancestor to supply SQL string for reload
        return '';
    }

    /**
     * Reload object from database
     *
     * reload data to an existing object
     *
     * @param       $obj
     * @param mixed $key unique identifier for object
     *
     * @return bool Descendent of CDMBase
     */

    public function reload(&$obj, $key = null)
    {
        $cn = mb_strtolower($this->classname);

        if (!get_class($obj) == $cn) {
            $this->setError(-1, sprintf(_MD_CDM_ERR_3, get_class($obj), $cn));

            return false;
        }

        if ($key) {
            $sql = $this->_reload($key);

            if ($result = $this->db->query($sql)) {
                if (1 == $this->db->getRowsNum($result)) {
                    $obj->assignVars($this->db->fetchArray($result));

                    $obj->unsetNew(); //flag as not new so that if subsequently inserted it will be updated.
                    $obj->unsetDirty(); //flag as clean (not modified)
                    return true;
                }

                $this->setError(-1, sprintf(_MD_CDM_ERR_1, (string)$key));
            } else {
                $this->setError($this->db->errno(), $this->db->error());
            }
            //end if
        } else {
            $this->setError(-1, _MD_CDM_ERR_4);
        }

        //end if
        return false; //default return
    }

    /**
     * OVERIDE in ancestor to provide an INSERT string for insert function
     *
     * You can generate a new variable with the same name as the key of
     * the cleanVars array and a value equal to the value element
     * of that array using;
     * <code>
     *  foreach ($cleanVars as $k => $v) {
     *    ${$k} = $v;
     *  }
     * </code>
     *
     * @abstract
     *
     * @param $cleanVars
     * @return string SQL string to insert object data into database
     */

    public function _ins_insert($cleanVars)
    {
        return '';
    }

    /**
     * OVERIDE in ancestor to provide an UPDATE string for insert function
     *
     * You can generate a new variable with the same name as the key of
     * the cleanVars array and a value equal to the value element
     * of that array using;
     * <code>
     *  foreach ($cleanVars as $k => $v) {
     *    ${$k} = $v;
     *  }
     * </code>
     *
     * @abstract
     *
     * @param $cleanVars
     * @return string SQL string to update object data into database
     */

    public function _ins_update($cleanVars)
    {
        return '';
    }

    /**
     * Write an object back to the database
     *
     * Overide in ancestor only if you need to add extra process
     * before or after the insert.
     *
     * @param \XoopsObject $obj
     *
     * @return  bool             True if successful
     */

    public function insert(XoopsObject $obj)
    {
        if (!$obj->isDirty()) {
            return true;
        } // if data is untouched then don't save
        // Set default values
        $obj->setRowInfo(); //set row edit infos ** you MUST call this prior to an update and prior to cleanVars**

        if ($obj->isNew()) {
            $obj->setVar('row_flag', CDM_RSTAT_ACT); //its a new code so it is 'Active'

            //next line not really required for mysql, but left in for future compatibility

            $obj->setVar('id', $this->db->genId($this->ins_tagname));
        }

        // set up 'clean' 2 element array of data items k=>v

        if (!$obj->cleanVars()) {
            return false;
        }

        //get the sql for insert or update

        $sql = ($obj->isNew() ? $this->_ins_insert($obj->cleanVars) : $this->_ins_update($obj->cleanVars));

        if (!$result = $this->db->queryF($sql)) {
            $this->setError($this->db->errno(), $this->db->error());

            return false;
        }

        $obj->unsetDirty(); //It has been saved so now it is clean

        if ($obj->isNew()) { //retrieve the new internal id for the code and store
            $id = $this->db->getInsertId();

            $obj->setVar('id', $id);

            $obj->unsetNew(); //it's been saved so it's not new anymore
        }

        return true;
    }

    //end function insert

    /**
     * Delete object from the database
     *
     * Actually all that happens is that the row is made 'defunct' here and saved to the
     * database
     *
     * @param \XoopsObject $obj
     * @return bool TRUE on success else False
     */

    public function delete(XoopsObject $obj)
    {
        $obj->setDefunct();

        return $this->insert($obj);
    }
} //end of class CDMBaseHandler
