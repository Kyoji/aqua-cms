<?php

/**
 * Config class for Aqua
 *
 * @since 0.1
 * @author Daniel Owens
 */

interface Config {
    public function getDBConfig();
    public function setDBConfig( $dbValues );
}

class AquaConfig implements Config {

    protected $database;
    public $templatesDir;
    protected $routes;

    function __construct()
    {
        $this->templatesDir = "templates";
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
}