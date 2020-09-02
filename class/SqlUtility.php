<?php declare(strict_types=1);

namespace XoopsModules\Xbscdm;

// $Id: sqlutility.php,v 1.1 2003/09/09 18:02:01 okazu Exp $
// sqlutility.php - defines utility class for MySQL database
/**
 * @package       CDM
 * @subpackage    API_Functions
 *
 * @author        Kazumi Ono    <onokazu@xoops.org>
 * @copyright     copyright (c) 2000-2003 XOOPS.org
 */

/**
 * provide some utility methods for databases
 *
 * This is an copy of the function found in xoops/class/database/sqlutility.php
 *
 * @author      Kazumi Ono <onokazu@xoops.org>, extension to function A Kitson
 * @copyright   copyright (c) 2000-2003 XOOPS.org
 *
 * @package     CDM
 * @subpackage  API_Functions
 */
class SqlUtility
{
    /**
     * Function from phpMyAdmin (http://phpwizard.net/projects/phpMyAdmin/)
     *
     * Removes comment and splits large sql files into individual queries
     *
     * Last revision: September 23, 2001 - gandon
     *
     * @param mixed $ret
     * @param mixed $sql
     *
     * @return  bool  always true
     * @access  public
     */
    public function splitMySqlFile(&$ret, $sql)
    {
        $sql = trim($sql);

        $sql_len = mb_strlen($sql);

        $char = '';

        $string_start = '';

        $in_string = false;

        for ($i = 0; $i < $sql_len; ++$i) {
            $char = $sql[$i];

            // We are in a string, check for not escaped end of

            // strings except for backquotes that can't be escaped

            if ($in_string) {
                for (; ;) {
                    $i = mb_strpos($sql, $string_start, $i);

                    // No end of string found -> add the current

                    // substring to the returned array

                    if (!$i) {
                        $ret[] = $sql;

                        return true;
                    } // Backquotes or no backslashes before

                    // quotes: it's indeed the end of the

                    // string -> exit the loop

                    if ('`' == $string_start || '\\' != $sql[$i - 1]) {
                        $string_start = '';

                        $in_string = false;

                        break;
                    } // one or more Backslashes before the presumed

                    // end of string...

                    // first checks for escaped backslashes

                    $j = 2;

                    $escaped_backslash = false;

                    while ($i - $j > 0 && '\\' == $sql[$i - $j]) {
                        $escaped_backslash = !$escaped_backslash;

                        $j++;
                    }

                    // ... if escaped backslashes: it's really the

                    // end of the string -> exit the loop

                    if ($escaped_backslash) {
                        $string_start = '';

                        $in_string = false;

                        break;
                    } // ... else loop

                    $i++;
                    // end if...elseif...else
                } // end for
            } // end if (in string)
            // We are not in a string, first check for delimiter...
            elseif (';' == $char) {
                // if delimiter found, add the parsed part to the returned array

                $ret[] = mb_substr($sql, 0, $i);

                $sql = ltrim(mb_substr($sql, min($i + 1, $sql_len)));

                $sql_len = mb_strlen($sql);

                if ($sql_len) {
                    $i = -1;
                } else {
                    // The submited statement(s) end(s) here

                    return true;
                }
            } // end else if (is delimiter)

            // ... then check for start of a string,...

            elseif (('"' == $char) || ('\'' == $char) || ('`' == $char)) {
                $in_string = true;

                $string_start = $char;
            } // end else if (is start of string)

            // for start of a comment (and remove this comment if found)...

            elseif ('#' == $char || (' ' == $char && $i > 1 && '--' == $sql[$i - 2] . $sql[$i - 1])) {
                // starting position of the comment depends on the comment type

                $start_of_comment = ('#' == $sql[$i] ? $i : $i - 2);

                // if no "\n" exits in the remaining string, checks for "\r"

                // (Mac eol style)

                $end_of_comment = mb_strpos(' ' . $sql, "\012", $i + 2) ?: mb_strpos(' ' . $sql, "\015", $i + 2);

                if (!$end_of_comment) {
                    // no eol found after '#', add the parsed part to the returned

                    // array and exit

                    // RMV fix for comments at end of file

                    $last = trim(mb_substr($sql, 0, $i - 1));

                    if (!empty($last)) {
                        $ret[] = $last;
                    }

                    return true;
                }

                $sql = mb_substr($sql, 0, $start_of_comment) . ltrim(mb_substr($sql, $end_of_comment));

                $sql_len = mb_strlen($sql);

                $i--;
                // end if...else
            }
            // end else if (is comment)
        } // end for

        // add any rest to the returned array

        if (!empty($sql) && '' != trim($sql)) {
            $ret[] = $sql;
        }

        return true;
    }

    /**
     * add a prefix.'_' to all tablenames in a query
     *
     * This is a copy of the function found in xoops/class/database/sqlutility.php
     * except that the search pattern for commands has been extended to include DELETE FROM
     * the @lang parameter has also been added so that we can set the langauge for a code
     *
     * @author  A Kitson (http://xoobs.net)
     *
     * @param string $query  valid SQL query string
     * @param string $prefix prefix to add to all table names
     * @param string $lang   language code to replace @lang in sql string
     *
     * @return  mixed   FALSE on failure
     */
    public function prefixQuery($query, $prefix, $lang)
    {
        $pattern = "/^(INSERT INTO|CREATE TABLE|ALTER TABLE|UPDATE|DELETE FROM)(\s)+([`]?)([^`\s]+)\\3(\s)+/siU";

        $pattern2 = "/^(DROP TABLE)(\s)+([`]?)([^`\s]+)\\3(\s)?$/siU";

        $pattern3 = '/(@lang)/siU';

        // find the language constant if it exists and replace with real value

        if (preg_match($pattern3, $query, $matches)) {
            $matches = preg_split($pattern3, $query);

            $query = $matches[0] . $lang . $matches[1];
        }

        // prepend any table names with xoops database table prefix

        if (preg_match($pattern, $query, $matches) || preg_match($pattern2, $query, $matches)) {
            $replace = '\\1 ' . $prefix . '_\\4\\5';

            $matches[0] = preg_replace($pattern, $replace, $query);

            return $matches;
        }

        return false;
    }
}
