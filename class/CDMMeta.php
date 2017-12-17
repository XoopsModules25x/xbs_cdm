<?php
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <https://xoops.org/>                             //
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
 * @package       CDM
 * @subpackage    CDMMeta
 * @author        Ashley Kitson http://xoobs.net
 * @copyright (c) 2004 Ashley Kitson, Great Britain
 */

if (!defined('XOOPS_ROOT_PATH')) {
    exit('Call to include CDMMeta.php failed as XOOPS_ROOT_PATH not defined');
}

/**
 * Require statements
 */
require_once CDM_PATH . '/class/class.cdm.base.php';

/**
 * Object handler for CDMMeta
 *
 * @package    CDM
 * @subpackage CDMMeta
 */
class Xbs_CdmCDMMetaHandler extends CDMBaseHandler
{
    /**
     * Constructor
     *
     * @param xoopsDb &$db Handle to database object
     */
    public function __construct($db)
    {
        parent::__construct($db); //call ancestor constructor
        $this->classname = 'cdmmeta'; //set name of object that this handler handles
    }

    /**
     * Create a new CDMMeta object
     *
     * @access private
     */
    public function &_create()
    {
        $obj = new CDMMeta();
        return $obj;
    }

    //end function _create

    /**
     * Construct a sql string to retrieve CDMMeta data
     *
     * @access private
     *
     * @param int    $id       id of meta set
     * @param string $row_flag =null Rowflag to match
     * @param string $lang     =null language set to use
     *
     * @return string SQl string to retrieve data
     */
    public function &_get($id, $row_flag = null, $lang = null)
    {
        $sql = sprintf('SELECT * FROM %s WHERE cd_set = %s', $this->db->prefix(CDM_TBL_META), $this->db->quoteString($id));
        $sql .= (empty($row_flag) ? '' : ' and row_flag = ' . $this->db->quoteString($row_flag));
        $sql .= (empty($lang) ? '' : ' and cd_lang = ' . $this->db->quoteString($lang));
        return $sql;
    }

    //end function _get

    /**
     *  Return meta set object based on its unique key
     *
     * @param string $set name of meta set
     *
     * @return CDMMeta meta set object
     */
    public function getkey($set)
    {
        return $this->get($set);
    }

    /**
     * create sql string to reload object data from database
     *
     * @access private
     *
     * @param int $key identifier of code object
     *
     * @return string the swql string
     */
    public function &_reload($key = null)
    {
        $sql = sprintf('SELECT * FROM %s WHERE cd_set = %s', $this->db->prefix(CDM_TBL_META), $this->db->quoteString($key));
        return $sql;
    }

    /**
     * Insert or update a meta set object
     *
     * @param \XoopsObject $meta
     *
     * @return boolean True if succeessful else False
     */
    public function insert(XoopsObject $meta)
    {
        if (!$meta->isDirty()) {
            return true;
        } // if data is untouched then don't save
        // Set default values
        $meta->setRowInfo(); //set row edit infos ** you MUST call this prior to an update and prior to cleanVars**
        if ($meta->isNew()) {
            $meta->setVar('row_flag', CDM_RSTAT_ACT); //its new so it is 'Active'
        }
        // set up 'clean' 2 element array of data items k=>v
        if (!$meta->cleanVars()) {
            return false;
        }

        // generate a new variable with the same name as the key of
        // the cleanVars array and a value equal to the value element
        // of that array.
        foreach ($meta->cleanVars as $k => $v) {
            ${$k} = $v;
        }

        if ($meta->isNew()) {
            $sql = sprintf(
                'INSERT INTO %s (cd_set,cd_type,cd_len,val_type,val_len,cd_desc,row_flag,row_uid,row_dt) VALUES (%s,%s,%u,%s,%u,%s,%s,%u,%s)',
                $this->db->prefix(CDM_TBL_META),
                $this->db->quoteString($cd_set),
                $this->db->quoteString($cd_type),
                $cd_len,
                $this->db->quoteString($val_type),
                           $val_len,
                $this->db->quoteString($cd_desc),
                $this->db->quoteString($row_flag),
                $row_uid,
                $this->db->quoteString($row_dt)
            );
        } else {
            $sql = sprintf(
                'UPDATE %s SET cd_type = %s,cd_len = %u,val_type = %s,val_len = %u,cd_desc = %s,row_flag = %s,row_uid = %u,row_dt = %s WHERE cd_set = %s',
                $this->db->prefix(CDM_TBL_META),
                $this->db->quoteString($cd_type),
                $cd_len,
                $this->db->quoteString($val_type),
                $val_len,
                           $this->db->quoteString($cd_desc),
                $this->db->quoteString($row_flag),
                $row_uid,
                $this->db->quoteString($row_dt),
                $this->db->quoteString($cd_set)
            );
        }
        //end sql string construction

        if (!$result = $this->db->query($sql)) {
            $this->setError($this->db->errno(), $this->db->error());
            return false;
        } else {

            //Because we are changing the meta code data, we need to change the row_status
            //flag of any dependent codes to be the same as the meta code data row_flag
            $sql = sprintf('UPDATE %s SET row_flag = %s WHERE cd_set = %s', $this->db->prefix(CDM_TBL_CODE), $this->db->quoteString($row_flag), $this->db->quoteString($cd_set));
            if (!$result = $this->db->query($sql)) {
                $this->setError($this->db->errno(), $this->db->error());
                return false;
            } else {
                $meta->unsetDirty(); //It has been saved so now it is clean
            }
        }

        if ($meta->isNew()) {
            $meta->unsetNew(); //it's been saved so it's not new anymore
        }
        return true;
    }

    //end function insert

    /**
     * Returns a list of available meta sets + data
     *
     * @param $row_flag  default = null = list all rows, else give a row_flag status
     *
     * @return array array of arrays containing data for each meta set
     */
    public function listMeta($row_flag = null)
    {
        $sql = 'SELECT * FROM ' . $this->db->prefix(CDM_TBL_META);
        $sql = (empty($row_flag) ? $sql : $sql . ' WHERE row_flag = ' . $this->db->quoteString($row_flag));
        $result = $this->db->query($sql) or exit('Error reading database');
        $ret = [];
        while ($myrow = $this->db->fetchArray($result)) {
            $ret[] = $myrow;
        }
        return $ret;
    }

    //end function listMeta

    /**
     * Check that a meta set is valid
     *
     * @param $setName string name of set to test if valid
     *
     * @return BOOLEAN TRUE if a valid set name else FALSE
     */
    public function isMetaSet($setName)
    {
        $sql = 'SELECT count(*) FROM ' . $this->db->prefix(CDM_TBL_META) . ' WHERE cd_set = ' . $this->db->quoteString($setName);
        $result = $this->db->query($sql) or exit('Error reading database');
        $ret = $this->db->fetchRow($result);
        return (1 == $ret[0]);
    }
    //end funcion isMetaSeta
} //end class CDMMetaHandler
