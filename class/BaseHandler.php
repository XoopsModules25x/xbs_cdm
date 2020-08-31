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
 * Object handler for CDM objects
 *
 * @package    CDM
 * @subpackage CDMBase
 * @abstract
 */
class BaseHandler extends \XoopsObjectHandler
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
            if ($obj) { //it is not new (forced by caller, usually &getAll()) but obj was created
                $obj->unsetNew();

                $obj->unsetDirty();
            } else {
                $this->setError(-1, sprintf(_MD_XBSCDM_ERR_2, $classname));

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

    public function getAll($id, $row_flag = null, $lang = null)
    {
        $test = (is_int($id) ? ($id > 0 ? true : false) : (!empty($id) ? true : false)); //test validity of id

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

                    $this->setError(-1, sprintf(_MD_XBSCDM_ERR_1, (string)$id));
                } else {
                    $this->setError($this->db->errno(), $this->db->error());
                }
                //end if
            }
            //end if - error value set in call to create()
        } else {
            $this->setError(-1, sprintf(_MD_XBSCDM_ERR_1, (string)$id));
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
        return $this->getAll($id, CDM_RSTAT_ACT, $lang);
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

    public function reload($obj, $key = null)
    {
        $cn = mb_strtolower($this->classname);

        if (!get_class($obj) == $cn) {
            $this->setError(-1, sprintf(_MD_XBSCDM_ERR_3, get_class($obj), $cn));

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

                $this->setError(-1, sprintf(_MD_XBSCDM_ERR_1, (string)$key));
            } else {
                $this->setError($this->db->errno(), $this->db->error());
            }
            //end if
        } else {
            $this->setError(-1, _MD_XBSCDM_ERR_4);
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

    public function insert(\XoopsObject $obj)
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

    public function delete(\XoopsObject $obj)
    {
        $obj->setDefunct();

        return $this->insert($obj);
    }
} //end of class BaseHandler
