<?php
/**
 * Outline
 * User vists website
 * current URI determined from URL
 * right-most slug checked against registered slugs
 * if found, renders page using registered entity
 * if not found, works left
 * if no match, renders using default
 */

namespace Aqua;

final class App {

    public $database;
    public $router;
    public $config;
    public $session;

    // THE only instance of the class
    private static $instance;

    private function __construct() {}

    function __init()
    {
        include('app/vendor/autoload.php');
        include('app/controllers/aqua_database.php');
        include('app/controllers/aqua_router.php');
        include('app/controllers/aqua_page.php');
        include('app/controllers/aqua_config.php');
        include('app/models/post.php');
        include('app/controllers/aqua_session.php');

        $this->session = Session::getInstance();
        $this->database = MySQLDatabase::getInstance();
        $this->config = Config::getInstance();
        $this->config->__init();
        //print_r($this->config);
        $this->database->__init( $this->config->getDBConfig() );
        $this->router = Router::getInstance();
        $this->router->__init();
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
$aqua = \Aqua\App::getInstance();
$aqua->__init();






