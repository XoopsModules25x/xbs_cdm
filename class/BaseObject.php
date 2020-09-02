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
class BaseObject extends \XoopsObject
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

        return $dte['year'] . '-' . str_pad((string)$dte['mon'], 2, '0', STR_PAD_LEFT) . '-' . str_pad((string)$dte['mday'], 2, '0', STR_PAD_LEFT) . ' ' . str_pad((string)$dte['hours'], 2, '0', STR_PAD_LEFT) . ':' . str_pad((string)$dte['minutes'], 2, '0', STR_PAD_LEFT) . ':' . str_pad(
                (string)$dte['seconds'],
                2,
                '0',
                STR_PAD_LEFT
            );
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
