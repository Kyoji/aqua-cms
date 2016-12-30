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

    function __construct()
    {
        include('app/vendor/autoload.php');
        include('app/controllers/aqua_database.php');
        include('app/controllers/aqua_router.php');
        include('app/controllers/aqua_page.php');
        include('app/config.php');
        include('app/models/post.php');
        include('app/controllers/aqua_session.php');

        $this->session = \Aqua\Session::getInstance();
//        $this->session->__set("logged_in", true);

//        echo $this->session->__get("logged_in");

        $this->database = new MySQLDatabase( $aquaConfig->getDBConfig() );
        $this->router = new Router( $this->database, $aquaConfig );

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
$aqua = new App();






