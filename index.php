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

include( 'vendor/autoload.php' );
include( 'models/post.php' );
include( 'controllers/aqua_database.php' );

class Page {
    protected $title;

    function __construct($posts)
    {

        include( 'templates/page.php' );
    }

    function getTitle()
    {
        return $this->title;
    }
}


class Router {

    public $URI = [
        'raw' => '',
        'list' => '',
        'list_reverse' => '',
        'current' => '',
        'isRoot' => NULL,
    ];

    public $registered_slugs = [];

    function __construct()
    {
        $this->populateURI();
    }

    protected function populateURI() {
        $URI = &$this->URI;
        if ( $_SERVER['REQUEST_URI'] != "/" ) {
            $raw = trim( $_SERVER['REQUEST_URI'], '/');
            $list = explode( '/', $raw );
            $list_reverse = array_reverse( $list );
            $current = $list_reverse[0];
            $URI = [
                'raw' => $raw,
                'list' => $list,
                'list_reverse' => $list_reverse,
                'current' => $current,
                'isRoot' => false,
            ];
        } else {
            $URI = ['isRoot' => true ];
        }

    }

    function route(  )
    {
        //$page = new Page( $this->URI );
    }

    function registerSlug( $slug, $entity )
    {
        // Add registered slug to end of array
        $this->registered_slugs[$slug] = $entity;
    }

}


$route = new Router();
$route->registerSlug( 'posts', 'Aqua\Post' );
echo $route->URI['current'];

//$page = new Page( $posts );
//echo $route->getCurrentDir();
//$page = new Page( $route->URI );

//$pdo = new AquaPDO();
//$foo_slug = 'foo';
$database = new MySQLDatabase();
$query = "SELECT * FROM aqua_posts WHERE post_slug = ".$route->URI['current'];
echo $query;
print_r($database->query($query));
//$stmt = $pdo->prepare('SELECT * FROM posts WHERE slug = :foo_slug');
//$stmt->execute(['foo_slug' => $route->URI['current']]);


