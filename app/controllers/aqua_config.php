<?php

/**
 * Config class for Aqua
 *
 * @since 0.1
 * @author Daniel Owens
 */

namespace Aqua;

class Config {

    protected $database;
    public $templatesDir;
    protected $routes;
    // THE only instance of the class
    private static $instance;

    function __construct()
    {
        $this->templatesDir = "app/templates";
    }

    public function __init() {
        $config = $this;
        $path = 'app/config/';
        $configFiles = array_diff( scandir($path), ['.','..'] );
        foreach ( $configFiles as $file )
        {
            include( $path.$file );
        }
    }

    public function getRoute( $route )
    {
        return $this->routes[$route];
    }

    public function setRoute( $route, $value )
    {
        $this->routes[$route] = $value;
    }

    public function getDBConfig() {
        return $this->database;
    }

    public function setDBConfig( $dbValues ) {
        $this->database['host'] = $dbValues['host'];
        $this->database['db'] = $dbValues['db'];
        $this->database['user'] = $dbValues['user'];
        $this->database['pass'] = $dbValues['pass'];
        $this->database['charset'] = $dbValues['charset'];
    }

    public static function getInstance()
    {
        if ( !isset(self::$instance))
        {
            self::$instance = new self;
        }

        return self::$instance;
    }
}