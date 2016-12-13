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

    function __construct()
    {
        $this->host = 'localhost';
        $this->db = 'aqua';
        $this->user = 'root';
        $this->pass = '';
        $this->charset = 'utf8mb4';

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

    function __construct(  )
    {
        $this->mySQLPDO = new AquaPDO();
    }
    function getPosts( $type = 'post' )
    {
        $pdo = &$this->mySQLPDO;
        $stmt = $pdo->prepare('SELECT * FROM aqua_posts WHERE type = :type');
        $stmt->execute(['type' => $type]);
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
}