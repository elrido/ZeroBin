<?php
/**
 * ZeroBin
 *
 * a zero-knowledge paste bin
 *
 * @link      http://sebsauvage.net/wiki/doku.php?id=php:zerobin
 * @copyright 2012 Sébastien SAUVAGE (sebsauvage.net)
 * @license   http://www.opensource.org/licenses/zlib-license.php The zlib/libpng License
 * @version   0.15
 */

/**
 * zerobin_db
 *
 * Model for DB access, implemented as a singleton.
 */
class zerobin_db extends zerobin_abstract
{
    /*
     * @access private
     * @static
     * @var PDO instance of database connection
     */
    private static $_db;

    /**
     * get instance of singleton
     *
     * @access public
     * @static
     * @return zerobin
     */
    public static function getInstance($options)
    {
        // if needed initialize the singleton
        if(null === self::$_instance) {
            parent::$_instance = new self;
        }
        if (
        	is_array($options) &&
        	array_key_exists('dsn', $options) &&
        	array_key_exists('usr', $options) &&
        	array_key_exists('pwd', $options) &&
        	array_key_exists('opt', $options)
        ) self::$_db = new PDO(
            $options['dsn'],
            $options['usr'],
            $options['pwd'],
            $options['opt']
        );
        return parent::$_instance;
    }

    /**
     * Create a paste.
     *
     * @access public
     * @param  string $pasteid
     * @param  array  $paste
     * @return int|false
     */
    public function create($pasteid, $paste)
    {
    }

    /**
     * Read a paste.
     *
     * @access public
     * @param  string $pasteid
     * @return string
     */
    public function read($pasteid)
    {
    }

    /**
     * Delete a paste and its discussion.
     *
     * @access public
     * @param  string $pasteid
     * @return void
     */
    public function delete($pasteid)
    {
    }

    /**
     * Test if a paste exists.
     *
     * @access public
     * @param  string $dataid
     * @return void
     */
    public function exists($pasteid)
    {
    }

    /**
     * Create a comment in a paste.
     *
     * @access public
     * @param  string $pasteid
     * @param  string $parentid
     * @param  string $commentid
     * @param  array  $comment
     * @return int|false
     */
    public function createComment($pasteid, $parentid, $commentid, $comment)
    {
    }

    /**
     * Read all comments of paste.
     *
     * @access public
     * @param  string $pasteid
     * @return array
     */
    public function readComments($pasteid)
    {
    }

    /**
     * Test if a comment exists.
     *
     * @access public
     * @param  string $dataid
     * @param  string $parentid
     * @param  string $commentid
     * @return void
     */
    public function existsComment($pasteid, $parentid, $commentid)
    {
    }
}