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
 * @package       CDM
 * @subpackage    Set
 * @copyright (c) 2004, Ashley Kitson
 * @copyright     XOOPS Project https://xoops.org/
 * @license       GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @author        Ashley Kitson http://akitson.bbcb.co.uk
 * @author        XOOPS Development Team
 */

xoops_loadLanguage('main', 'xbscdm');

/**
 * Object handler for Set
 *
 * @subpackage Set
 * @package    CDM
 */
class SetHandler extends BaseHandler
{
    /**
     * Constructor
     *
     * @param \XoopsDatabase $db Handle to xoopsDb object
     */
    public function __construct(\XoopsDatabase $db)
    {
        parent::__construct($db); //call ancestor constructor
        $this->classname = Set::class; //set name of object that this handler handles
    }

    /**
     * Create a new set of codes, including meta data and codes
     *
     * @access private
     * @return  Set object
     */
    public function _create()
    {
        return new Set();
    }

    //end function _create

    /**
     * Retrieve a set of data
     *
     * Although you can use this method, it is better to use get() as it ensures you only
     * retrieve 'Active' data.
     *
     * @param string $set           The code set to load
     * @param null   $meta_row_flag Option(CDM_RSTAT_ACT, ..SUS, ..DEF)  Applies only to the meta data
     * @param null   $code_row_flag Option(CDM_RSTAT_ACT, ..SUS, ..DEF)  Applies to the code data
     *
     * @param null   $lang
     * @return bool Set if OK, else FALSE on failure
     */
    public function getAll($set, $meta_row_flag = null, $code_row_flag = null, $lang = null)
    {
        if (!empty($set)) {
            $codeset = $this->create(false);

            if ($codeset) {
                $metaHandler = \XoopsModules\Xbscdm\Helper::getInstance()->getHandler('Meta');

                $meta = $metaHandler->getAll($set, $meta_row_flag);

                if ($meta) {
                    // store the Meta data

                    $codeset->assignVar('meta', $meta);

                    // Now get all the codes and store them in the 'code' array

                    $sql = 'SELECT id FROM ' . $this->db->prefix(CDM_TBL_CODE);

                    $sql .= ' where cd_set = ' . $this->db->quoteString($set);

                    $sql .= (empty($code_row_flag) || '' == $code_row_flag ? '' : ' and row_flag = ' . $this->db->quoteString($code_row_flag));

                    $sql .= (empty($lang) ? '' : ' and cd_lang = ' . $this->db->quoteString($lang));

                    $sql .= ' order by id';

                    $result = $this->db->query($sql);

                    if ($result) {
                        //check that we have some rows

                        if ($this->db->getRowsNum($result) > 0) {
                            //retrieve the code ids and create objects to store in our code array
                            $codeHandler = \XoopsModules\Xbscdm\Helper::getInstance()->getHandler('Code'); //get the code handler
                            $count       = 0;

                            $arr = [];

                            while (false !== ($row = $this->db->fetchRow($result))) {
                                $arr[$count++] = $codeHandler->getAll($row[0], $code_row_flag);
                            }

                            $codeset->assignVar('code', $arr);

                            return $codeset;
                        }   //set error code no data returned

                        $this->setError(-1, sprintf(_MD_XBSCDM_ERR_1, (string)$set));
                        // end if number of codes > 0
                    } else { //set database error code
                        $this->setError($this->db->errno(), $this->db->error());
                    }
                    //end if $result
                } else { //set error code unable to instantiate Meta
                    $this->setError(-1, sprintf(_MD_XBSCDM_ERR_2, 'Meta'));
                }
                //end if $meta
            } else { //set error code unable to instantiate Code
                $this->setError(-1, sprintf(_MD_XBSCDM_ERR_2, 'Code'));
            }
            //end if $code
        } else { //set error code $set not valid
            $this->setError(-1, _MD_XBSCDM_ERR_4);
        }

        //end if !empty(set)

        return false;
    }

    //end function &getall

    /**
     * Safe data get
     *
     * @param string $set  name of code set to retrieve
     * @param string $lang language set to use. Default CDM_DEF_LANG
     * @return bool
     */
    public function get($set, $lang = CDM_DEF_LANG)
    {
        return $this->getAll($set, CDM_RSTAT_ACT, CDM_RSTAT_ACT, $lang);
    }

    //end function get

    /**
     * @param string|null $set
     * @param string      $lang
     * @return object
     */
    public function getKey($set = null, $lang = CDM_DEF_LANG)
    {
        return $this->get($set, $lang);
    }

    //end function getkey

    /**
     * Function reload  - overwrite ancestor.  Does nothing
     *
     * @param      $obj
     * @param null $key
     * @return false
     */
    public function reload($obj, $key = null)
    {
        return false;
    }

    /**
     * Function insert - Does nothing.  Use getCode and getMeta to instantiate CDM objects and then
     * insert (save) them individually
     *
     * @param \XoopsObject $obj
     * @return false
     */
    public function insert(\XoopsObject $obj)
    {
        return false;
    }

    //end function insert

    /**
     * Function: countSets
     *
     * Count the number of Code Sets
     *
     * @return int number of sets
     * @version 1
     */
    public function countSets()
    {
        $sql = sprintf('SELECT count(*) FROM %s', $this->db->prefix(CDM_TBL_META));

        $result = $this->db->queryF($sql);

        $ret = $this->db->fetchRow($result);

        return $ret[0];
    }

    //end function countSets

    /**
     * return an array of All Setname,Setname pairs for use in an admin user form select box
     *
     * @return array
     */
    public function getSelectListAll()
    {
        $sql = sprintf('SELECT cd_set, row_flag FROM %s', $this->db->prefix(CDM_TBL_META));

        $result = $this->db->query($sql);

        $ret = [];

        while (false !== ($res = $this->db->fetchArray($result))) {
            switch ($res['row_flag']) {
                case CDM_RSTAT_DEF:
                    $ret[$res['cd_set']] = $res['cd_set'] . ' (' . CDM_RSTAT_DEF . ')';
                    break;
                case CDM_RSTAT_SUS:
                    $ret[$res['cd_set']] = $res['cd_set'] . ' (' . CDM_RSTAT_SUS . ')';
                    break;
                default:
                    $ret[$res['cd_set']] = $res['cd_set'];
                    break;
            }
            //end switch
        }

        //end while

        return $ret;
    }

    /**
     * return an array of Active Setname, Setname pairs for use in a end user form select box
     *
     * @return array
     */
    public function getSelectList()
    {
        $sql = sprintf('SELECT cd_set FROM %s WHERE row_flag= %s', $this->db->prefix(CDM_TBL_META), $this->db->quoteString(CDM_RSTAT_ACT));

        $result = $this->db->query($sql);

        $ret = [];

        while (false !== ($res = $this->db->fetchArray($result))) {
            $ret[$res['cd_set']] = $res['cd_set'];
        }

        return $ret;
    }

    /**
     * Function: Return available languages for the set
     *
     * Interrogates the code set to see what languages are defined for the set
     *
     * @param string $set name of set
     *
     * @return array array of language codes (langCode => Language Name)
     * @version 1
     *
     */
    public function getAvailLanguage($set)
    {
        //find the languages for which codes are defined in the set

        $sql = sprintf('SELECT DISTINCT cd_lang FROM %s WHERE cd_set = %s AND row_flag = %s', $this->db->prefix(CDM_TBL_CODE), $this->db->quoteString($set), $this->db->quoteString(CDM_RSTAT_ACT));

        $result = $this->db->query($sql);

        $str = '(';

        while (false !== ($res = $this->db->fetchArray($result))) {
            $str .= $this->db->quoteString($res['cd_lang']) . ',';
        }

        //get the language codes and values
        $str = mb_substr($str, 0, -1); //get rid of trailing comma
        $str .= ')';

        $sql = sprintf('SELECT cd,cd_value FROM %s WHERE cd_set= %s AND cd IN %s AND row_flag = %s', $this->db->prefix(CDM_TBL_CODE), $this->db->quoteString('LANGUAGE'), $str, $this->db->quoteString(CDM_RSTAT_ACT));

        $result = $this->db->query($sql);

        $ret = [];

        while (false !== ($res = $this->db->fetchArray($result))) {
            $ret[$res['cd']] = $res['cd_value'];
        }

        return $ret;
    }

    /**
     * Function: Determine if a saved list of code-codevalue pairs has been saved todatabase
     *
     * To speed up html selector list retreival, we save a precompiled list to the database.  This function looks to see if one is available.
     *
     * @param string $setName . Name of set to look for
     * @param string $fldName . Name of field being used for code display value
     * @param bool   $isAll   If true then retrieve the complete code list else just the active data
     * @param bool   $isTree  If true then the list a tree format selector, else it is an ordinary list
     * @param string $lang    code set language to use
     *
     * @return bool True if list exists else false
     * @version 1
     * @internal
     *
     */
    public function isListLoaded($setName, $fldName = 'cd_value', $isAll = false, $isTree = false, $lang = CDM_DEF_LANG)
    {
        $sql = sprintf("SELECT count(*) AS 'count' FROM %s WHERE cd_set =%s AND cd_lang = %s AND subset = %d AND tree = %d AND fld = %s", $this->db->prefix(CDM_TBL_LIST), $this->db->quoteString($setName), $this->db->quoteString($lang), $isAll, $isTree, $this->db->quoteString($fldName));

        $result = $this->db->query($sql);

        $ret = $this->db->fetchArray($result);

        if (1 == $ret['count']) {
            return true;
        }

        return false;
    }

    //end function

    /**
     * Function: Retrieve saved cache list
     *
     * To speed up html selector list retreival, we save a precompiled list to the database.  This function returns it to caller
     *
     * @param string $setName . Name of set to look for
     * @param string $fldName . Name of field being used for code display value
     * @param bool   $isAll   If true then retrieve the complete code list else just the active data
     * @param bool   $isTree  If true then the list a tree format selector, else it is an ordinary list
     * @param string $lang    code set language to use
     *
     * @return mixed array of code values if successful else false
     * @version 1
     * @internal
     *
     */
    public function getList($setName, $fldName = 'cd_value', $isAll = false, $isTree = false, $lang = CDM_DEF_LANG)
    {
        $sql = sprintf('SELECT cd_list FROM %s WHERE cd_set =%s AND cd_lang = %s AND subset = %d AND tree=%d AND fld=%s', $this->db->prefix(CDM_TBL_LIST), $this->db->quoteString($setName), $this->db->quoteString($lang), $isAll, $isTree, $this->db->quoteString($fldName));

        $result = $this->db->query($sql);

        if ($ret = $this->db->fetchArray($result)) {
            return unserialize($ret['cd_list']);
        }

        return false;
    }

    //end function

    /**
     * Function: Save a code-codevalue array list to the database cache
     *
     * To speed up html selector list retreival, we save a precompiled list to the database.  This function saves the list to the database
     *
     * @param array  $list    . array of code=>code value pairs to save
     * @param string $setName . Name of set to look for
     * @param string $fldName . Name of field being used for code display value
     * @param bool   $isAll   If true then retrieve the complete code list else just the active data
     * @param bool   $isTree  If true then the list a tree format selector, else it is an ordinary list
     * @param string $lang    code set language to use
     *
     * @return bool True if successful else false
     * @internal
     *
     * @version 1
     */
    public function saveList($list, $setName, $fldName = 'cd_value', $isAll = false, $isTree = false, $lang = CDM_DEF_LANG)
    {
        $sql = sprintf(
            'INSERT INTO %s (cd_set, cd_lang, subset, tree, cd_list, fld) VALUES (%s,%s,%d,%d,%s,%s)',
            $this->db->prefix(CDM_TBL_LIST),
            $this->db->quoteString($setName),
            $this->db->quoteString($lang),
            $isAll,
            $isTree,
            $this->db->quoteString(serialize($list)),
            $this->db->quoteString($fldName)
        );

        //We must use queryF to ensure the insert statement can be processed

        // during any GET form operations

        if (!$result = $this->db->queryF($sql)) {
            $this->setError($this->db->errno(), $this->db->error());

            return false;
        }

        return true;
    }

    //end function

    /**
     * Function: Delete a cached code->codevalue array list
     *
     * To speed up html selector list retreival, we save a precompiled list to the database.  This function deletes all lists for a code set from the database
     *
     * @param string $setName . Name of set to look for
     * @param string $lang    code set language to use
     *
     * @return bool True if successful else false
     * @internal
     *
     * @version 1
     */
    public function delList($setName, $lang = CDM_DEF_LANG)
    {
        $sql = sprintf('DELETE FROM %s WHERE cd_set=%s AND cd_lang=%s', $this->db->prefix(CDM_TBL_LIST), $this->db->quoteString($setName), $this->db->quoteString($lang));

        //We must use queryF to ensure the delete statement can be processed

        // during any GET form operations

        if (!$result = $this->db->queryF($sql)) {
            $this->setError($this->db->errno(), $this->db->error());

            return false;
        }

        return true;
    }
    //end function
} //end class CDMSetHandler
