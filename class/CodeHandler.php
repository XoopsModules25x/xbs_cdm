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
 * @package       CDM
 * @subpackage    Code
 * @author        Ashley Kitson http://xoobs.net
 * @copyright (c) 2004 Ashley Kitson, Great Britain
 */


/**
 * Object handler for Code
 *
 * @package    CDM
 * @subpackage Code
 */
class CodeHandler extends BaseHandler
{
    /**
     * Constructor
     *
     * @param \XoopsDatabase $db Handle to database object
     */
    public function __construct(\XoopsDatabase $db)
    {
        parent::__construct($db); //call ancestor constructor

        $this->classname = 'cdmcode';

        $this->ins_tagname = 'cdm_ins_code';
    }

    /**
     * Create a new Code object
     *
     * @access private
     */
    public function _create()
    {
        return new Code();
    }

    //end function _create

    /**
     * Construct a sql string to retrieve Code data
     *
     * @access private
     *
     * @param int    $key      id of code
     * @param string $row_flag =null Rowflag to match
     * @param string $lang     =null language set to use
     *
     * @return string SQl string to retrieve data
     */
    public function &_get($key, $row_flag = null, $lang = null)
    {
        $sql = sprintf('SELECT * FROM %s WHERE id = %u', $this->db->prefix(CDM_TBL_CODE), $key);

        $sql .= (empty($row_flag) ? '' : ' and row_flag = ' . $this->db->quoteString($row_flag));

        $sql .= (empty($lang) ? '' : ' and cd_lang = ' . $this->db->quoteString($lang));

        return $sql;
    }

    //end function _get

    /**
     * Populate 'kids' variable for code object
     *
     * If the code has child codes, then populates the 'kids' variable
     * with the internal Ids of those codes
     *
     * @access private
     *
     * @param Code $code Handle to Code object
     * @return null
     * @return null
     */
    public function _getKids($code)
    {
        $id = $code->getVar('id');

        $cd = $code->getVar('cd');

        $cd_set = $code->getVar('cd_set');

        $cd_lang = $code->getVar('cd_lang');

        $sql = sprintf("SELECT id, cd FROM %s WHERE cd_prnt = '%s' AND cd_set = '%s' AND cd_lang = '%s' AND id <> %d ORDER BY id", $this->db->prefix(CDM_TBL_CODE), $cd, $cd_set, $cd_lang, $id);

        if ($result = $this->db->query($sql)) {
            $keys = [];

            $codes = [];

            while (false !== ($key = $this->db->fetchRow($result))) {
                $keys[] = (int)$key[0];

                $codes[] = $key[1];
            }

            $code->assignVar('_kidsint', $keys);

            $code->assignVar('_kidscode', $codes);
        }

        return null;
    }

    //end function getKids

    /**
     * Function: get code meta data
     *
     * fills a Code object with code meta data from set meta record
     *
     * @param Code &$code Handle to Code object
     * @return null
     * @return null
     * @version 1
     * @access  private
     *
     */
    public function _getMetaData($code)
    {
        $metaHandler = \XoopsModules\Xbscdm\Helper::getInstance()->getHandler('Meta');

        $meta = $metaHandler->getAll($code->getVar('cd_set'));

        $code->setVar('_cd_type', $meta->getVar('cd_type'));

        $code->setVar('_cd_len', $meta->getVar('cd_len'));

        $code->setVar('_val_type', $meta->getVar('val_type'));

        $code->setVar('_val_len', $meta->getVar('val_len'));

        return null;
    }

    /**
     * Get all data for object given id.
     *
     * OVERIDES BaseHandler to construct child code sequence array
     * for the code.  Copies meta info in from meta record
     * For safety use the get method which will only return Active rows.
     *
     * @access private
     *
     * @param int    $id       data item internal identifier
     * @param string $row_flag default null (get all), Option(CDM_RSTAT_ACT, CDM_RSTAT_DEF, CDM_RSTAT_SUS)
     * @param string $lang     default null (get all), Valid LANGUAGE code.  Will only return object of that language set
     *
     * @return object descendent of CDMBase
     */
    public function getAll($id, $row_flag = null, $lang = null)
    {
        $code = parent::getAll($id, $row_flag, $lang);

        if ($code) {
            //construct child code list and assign to kids variable

            $this->_getKids($code);

            //get meta info

            $this->_getMetaData($code);

            return $code;
        }

        return false;
    }

    //end function &getall

    /**
     *  Return code object internal identifier (primary key) based on its unique user key
     *
     * Overides ancestor
     *
     * @param string $cd   code to retrieve
     * @param string $set  codeset to retrieve
     * @param string $lang language set to retrieve
     *
     * @return mixed if success else False.
     */
    public function getKey($cd, $set, $lang)
    {
        $sql = 'SELECT id FROM ' . $this->db->prefix(CDM_TBL_CODE) . ' WHERE cd = ' . $this->db->quoteString($cd) . ' AND cd_set = ' . $this->db->quoteString($set) . ' AND cd_lang = ' . $this->db->quoteString($lang);

        if ($result = $this->db->query($sql)) {
            if (1 == $this->db->getRowsNum($result)) {
                $id = $this->db->fetchArray($result);

                return $id['id'];
            } //end if
        } //end if
        return false;
    }

    //end function getKey

    /**
     * create sql string to reload object data from database
     *
     * @access private
     *
     * @param int $key identifier of code object
     *
     * @return string the swql string
     */
    public function _reload($key = null)
    {
        return sprintf('SELECT * FROM %s WHERE id = %u', $this->db->prefix(CDM_TBL_CODE), $key);
    }

    /**
     * create sql string to insert a new code object to database
     *
     * @access private
     *
     * @param array $cleanVars array of cleaned up data elements
     *
     * @return string the sql string to insert the object
     */
    public function _ins_insert($cleanVars)
    {
        foreach ($cleanVars as $k => $v) {
            ${$k} = $v;
        }

        $sql = sprintf(
            'INSERT INTO %s (id, cd_set,cd_lang,cd,cd_prnt,cd_value,cd_desc,cd_param,row_flag,row_uid,row_dt) VALUES (%u,%s,%s,%s,%s,%s,%s,%s,%s,%u,%s)',
            $this->db->prefix(CDM_TBL_CODE),
            $id,
            $this->db->quoteString($cd_set),
            $this->db->quoteString($cd_lang),
            $this->db->quoteString($cd),
            $this->db->quoteString($cd_prnt),
            $this->db->quoteString($cd_value),
            $this->db->quoteString($cd_desc),
            $this->db->quoteString($cd_param),
            $this->db->quoteString($row_flag),
            $row_uid,
            $this->db->quoteString($row_dt)
        );

        return $sql;
    }

    /**
     * create sql string to update an existing code object
     *
     * @access private
     *
     * @param array $cleanVars array of cleaned up data elements
     *
     * @return string the sql string to update the object
     */
    public function _ins_update($cleanVars)
    {
        foreach ($cleanVars as $k => $v) {
            ${$k} = $v;
        }

        $sql = sprintf(
            'UPDATE %s SET cd_set = %s,cd_lang = %s,cd = %s,cd_prnt = %s,cd_value = %s,cd_desc = %s,cd_param = %s,row_flag = %s,row_uid = %u,row_dt = %s WHERE id = %u',
            $this->db->prefix(CDM_TBL_CODE),
            $this->db->quoteString($cd_set),
            $this->db->quoteString($cd_lang),
            $this->db->quoteString($cd),
            $this->db->quoteString($cd_prnt),
            $this->db->quoteString($cd_value),
            $this->db->quoteString($cd_desc),
            $this->db->quoteString($cd_param),
            $this->db->quoteString($row_flag),
            $row_uid,
            $this->db->quoteString($row_dt),
            $id
        );

        return $sql;
    }

    /**
     * Insert or update a code object
     *
     * @param \XoopsObject $code
     *
     * @return bool True if succeessful else False
     */
    public function insert(\XoopsObject $code)
    {
        if (!$code->isDirty()) {
            return true;
        } // if data is untouched then don't save

        // Set default values

        $cd_lang = $code->getVar('cd_lang');

        $cd_lang = (empty($cd_lang) ? CDM_DEF_LANG : $cd_lang);

        $code->setVar('cd_lang', $cd_lang); //default code language if none given

        $cd_set = $code->getVar('cd_set');

        $cd_set = (empty($cd_set) ? CDM_DEF_SET : $cd_set);

        $code->setVar('cd_set', $cd_set); //default codeset for a code if none given

        //check referential integrity of cd_set

        $sql = sprintf('SELECT count(*) FROM %s WHERE cd_set = %s', $this->db->prefix(CDM_TBL_META), $this->db->quoteString($cd_set));

        if ($result = $this->db->query($sql)) {
            $row = $this->db->fetchRow($result);

            if (!$row[0]) { //return value = zero so cd_set is not a set
                $this->setError(-1, $cd_set . ' ' . _MD_CDM_ERR_6);

                return false;
            }
        } else { //never likely to happen as SQL should return 1 or 0
            return false;
        }

        //run ancestor

        $ret = parent::insert($code);

        //delete the cached lists for a code set.  They are now out of date

        //  The next call to get a select list will update them

        $setHandler = \XoopsModules\Xbscdm\Helper::getInstance()->getHandler('Set');

        return $ret && $setHandler->delList($cd_set, $cd_lang);
    }
    //end function insert
} //end class CDMCodeHandler
