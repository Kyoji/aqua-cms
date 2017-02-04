<?php

namespace Aqua;

// All local values for now, who cares if it's public ;)

class AquaPDO extends \PDO
{

    protected $host;
    protected $db;
    protected $user;
    protected $pass;
    protected $charset;

    protected $dsn;
    protected $opt = [
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        \PDO::ATTR_EMULATE_PREPARES => false,
    ];
    protected $pdo;

    function __construct( $dbValues )
    {
        $this->host = $dbValues['host'];
        $this->db = $dbValues['db'];
        $this->user = $dbValues['user'];
        $this->pass = $dbValues['pass'];
        $this->charset = $dbValues['charset'];

        $this->dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";

        parent::__construct($this->dsn, $this->user, $this->pass, $this->opt);
    }

}

interface Database
{
    function getPosts();
}

class MySQLDatabase implements Database
{

    protected $mySQLPDO;
    // THE only instance of the class
    private static $instance;

    function __init( $dbValues )
    {
        $this->mySQLPDO = new AquaPDO( $dbValues );
    }
    function getPosts( $type = 'post' )
    {
        $pdo = &$this->mySQLPDO;
        $stmt = $pdo->prepare('SELECT * FROM aqua_posts');
        $stmt->execute(); // $stmt->execute(['type' => $type]);
        return $stmt->fetchAll(\PDO::FETCH_CLASS, 'Aqua\Post');
    }

    function getPostBy($type = 'id', $query = '1')
    {
        $pdo = &$this->mySQLPDO;

        $stmt = $pdo->prepare('SELECT * FROM aqua_posts WHERE ' . $type . ' = :query');
        $stmt->execute(['query' => $query]);

        return $stmt->fetchAll(\PDO::FETCH_CLASS, 'Aqua\Post');
    }

    function query($query, $fetch = ['FETCH_ASSOC', 'Aqua\Post'])
    {
        $pdo = &$this->mySQLPDO;
        $stmt = $pdo->prepare($query);
        $stmt->execute();

        if ($fetch[0] == 'FETCH_CLASS') {
            return call_user_func_array([$stmt, "fetchAll"], [constant('\PDO::' . $fetch[0]), $fetch[1]]);
        } else {
            return call_user_func_array([$stmt, "fetchAll"], [constant('\PDO::' . $fetch[0])]);
        }

    }

    function getEnabledModules()
    {
        $pdo = &$this->mySQLPDO;
        $stmt = $pdo->prepare( 'SELECT * FROM modules WHERE enabled = 1' );
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function getInstance()
    {
        if ( !isset(self::$instance))
        {
            self::$instance = new self();
        }

        return self::$instance;
    }
}