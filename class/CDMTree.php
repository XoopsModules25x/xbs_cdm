<?php
// $Id: tree.php,v 1.12 2003/09/26 10:17:45 okazu Exp $
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
// Author: A Kitson after Kazumi Ono (AKA onokazu)                           //
// This is based on XoopsObjectTree which doesn't work as expected
// ------------------------------------------------------------------------- //

/**
 * Defines CDMObjectTree class
 *
 * @package        CDM
 * @subpackage     CDMTree
 *
 * @author         A Kitson (http://xoobs.net)
 * @copyright  (c) 2005 Ashley Kitson, Great Britain
 */

/**
 * A tree structure with {@link CDMBaseObject}s as nodes
 * This is based on XoopsObjectTree which doesn't work as expected
 *
 * @package        CDM
 * @subpackage     CDMTree
 *
 * @author         A Kitson (http://xoobs.net)
 * @copyright  (c) 2005 Ashley Kitson, Great Britain
 */
class CDMObjectTree
{

    /**#@+
     * @access    private
     */
    public $_parentId;
    public $_myId;
    public $_tree = [];
    public $_objects;

    /**#@-*/

    /**
     * Constructor
     *
     * @param   array  $objectArr Array of {@link CDMObject}s
     * @param   string $myId      field name of object ID
     * @param   string $parentId  field name of parent object ID
     **/
    public function __construct(&$objectArr, $myId, $parentId)
    {
        $this->_objects  =& $objectArr;
        $this->_myId     = $myId;
        $this->_parentId = $parentId;
        foreach (array_keys($this->_objects) as $i) {
            $key1                      = rtrim($this->_objects[$i]->getVar($this->_myId));
            $this->_tree[$key1]['obj'] =& $this->_objects[$i];
            $key2                      = rtrim($this->_objects[$i]->getVar($this->_parentId));
            $f1                        = is_null($key2);
            $f2                        = ('' == $key2);
            $f3                        = (0 == strlen($key2));
            $flag                      = ($f1 || $f2 || $f3);
            if (!$flag) {
                $this->_tree[$key1]['parent']  = $key2;
                $this->_tree[$key2]['child'][] = $key1;
            }
        }
    }

    /**
     * Get the tree
     *
     * @return  array   Associative array comprising the tree
     **/
    public function &getTree()
    {
        return $this->_tree;
    }

    /**
     * Make options for a select box
     *
     * @param   string $fieldName   Name of the member variable from the
     *                              node objects that should be used as the title for the options.
     * @param   string $selected    Value to display as selected
     * @param   int    $key         ID of the object to display as the root of select options
     * @param   string $ret         (reference to a string when called from outside) Result from previous recursions
     * @param   string $prefix_orig String to indent items at deeper levels
     * @param   string $prefix_curr String to indent the current item
     *
     * @access    private
     **/
    public function _makeSelBoxOptions($fieldName, $selected, $key, &$ret, $prefix_orig, $prefix_curr = '')
    {
        if (!empty($key) || ($key > 0)) {
            $value = $this->_tree[$key]['obj']->getVar($this->_myId);
            $ret   .= '<option value="' . $value . '"';
            if ($value == $selected) {
                $ret .= ' selected="selected"';
            }
            $ret         .= '>' . $prefix_curr . $this->_tree[$key]['obj']->getVar($fieldName) . '</option>';
            $prefix_curr .= $prefix_orig;
        }
        if (isset($this->_tree[$key]['child']) && !empty($this->_tree[$key]['child'])) {
            foreach ($this->_tree[$key]['child'] as $childkey) {
                $this->_makeSelBoxOptions($fieldName, $selected, $childkey, $ret, $prefix_orig, $prefix_curr);
            }
        }
    }

    /**
     * Make a select box with options from the tree
     *
     * NB, this makes only the selection box, not its label etc.
     * To use a fully formed selection box use CDMFormTreeSelect() to be found
     * in class.cdm.form.php
     *
     * @param   string  $name           Name of the select box
     * @param   string  $fieldName      Name of the member variable from the
     *                                  node objects that should be used as the title for the options.
     * @param   string  $selected       Value to display as selected
     * @param   string  $prefix         String to indent deeper levels
     * @param   bool    $addEmptyOption Set TRUE to add an empty option with value "0" at the top of the hierarchy
     * @param   integer $key            ID of the object to display as the root of select options
     *
     * @return  string  HTML select box
     **/
    public function &makeSelBox($name, $fieldName, $selected = '', $prefix = '-', $addEmptyOption = false, $key = 0)
    {
        $ret = '<select name=' . $name . '>';
        if (false !== $addEmptyOption) {
            $ret .= '<option value="0"></option>';
        }
        foreach (array_keys($this->_tree) as $key) {
            if (!isset($this->_tree[$key]['parent'])) { //don't duplicate items that are children of others
                $this->_makeSelBoxOptions($fieldName, $selected, $key, $ret, $prefix);
            }
        }
        return $ret . '</select>';
    }

    //end function

    /**
     * function _getSelArrs
     *
     * recursive helper function for getSelArr
     *
     * @access private
     *
     * @param string   $dispFld     name of field to use for displaying select option
     * @param mixed    $key         key to tree item to process
     * @param array    $ret         array of options to be built
     * @param   string $prefix_orig String to indent items at deeper levels
     * @param   string $prefix_curr String to indent the current item
     */
    public function _getSelArrs($dispFld, $key, &$ret, $prefix_orig, $prefix_curr = '')
    {
        if (!empty($key) || ($key > 0)) {
            $id          = $this->_tree[$key]['obj']->getVar($this->_myId);
            $value       = $prefix_curr . $this->_tree[$key]['obj']->getVar($dispFld);
            $ret[$id]    = $value;
            $prefix_curr .= $prefix_orig;
        }
        if (isset($this->_tree[$key]['child']) && !empty($this->_tree[$key]['child'])) {
            foreach ($this->_tree[$key]['child'] as $childkey) {
                $this->_getSelArrs($dispFld, $childkey, $ret, $prefix_orig, $prefix_curr);
            }
        }
    }

    //end function

    /**
     * Function getSelArr
     *
     * creates an associative array of code=>value where value is indented
     * by $prefix if not a level zero node in the tree.  Primarily
     * intended to be used by CDMFormTreeSelect() to create a selection form box
     *
     * @param string $dispFld name of field to use for value
     * @param string $prefix  character used to indent tree hierarchy
     *
     * @return array associative array 'code => value' of the code set in tree hierarchy order
     */
    public function getSelArr($dispFld = 'cd_value', $prefix = '-')
    {
        $ret = [];
        foreach (array_keys($this->_tree) as $key) {
            if (!isset($this->_tree[$key]['parent'])) { //don't duplicate items that are children of others
                $this->_getSelArrs($dispFld, $key, $ret, $prefix);
            }
        }
        return $ret;
    }
    //end function
}

//end class
