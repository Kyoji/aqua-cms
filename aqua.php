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

    protected $database;
    protected $router;

    function __construct()
    {
        include( 'vendor/autoload.php' );
        include( 'models/post.php' );
        include( 'controllers/aqua_database.php' );
        include( 'controllers/aqua_router.php' );
        include( 'controllers/aqua_page.php' );
        include( 'config.php' );

        $this->database = new MySQLDatabase( $aquaConfig->getDBConfig() );
        $this->router = new Router( $this->database, $aquaConfig );
    }
}
$aqua = new App();





