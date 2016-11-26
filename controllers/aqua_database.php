<?php

namespace Aqua;

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
        $this->db = 'Aqua';
        $this->user = 'root';
        $this->pass = '';
        $this->charset = 'utf8';

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
        $pdo = $this->mySQLPDO;

        $stmt = $pdo->prepare('SELECT * WHERE type = :type');
        $stmt = $pdo->exec( ['type' => 'post'] );
        return $stmt;
    }

}