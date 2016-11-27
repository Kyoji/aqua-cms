<?php
/**
 * Created by PhpStorm.
 * User: danielowens
 * Date: 11/19/16
 * Time: 11:19 PM
 */

namespace Aqua;

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


    function __construct()
    {
        $this->populateURI();
        print_r( $this->URI );
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

}





$route = new Router();
//$page = new Page( $posts );
//echo $route->getCurrentDir();
//$page = new Page( $route->URI );


//$pdo = new AquaPDO();
//$foo_slug = 'foo';
//$stmt = $pdo->prepare('SELECT * FROM posts WHERE slug = :foo_slug');
//$stmt->execute(['foo_slug' => $foo_slug]);

$database = new MySQLDatabase();
$posts = $database->query('SELECT * FROM posts', ['FETCH_CLASS', 'Aqua\Post']);

foreach ($posts as $post) {
    print_r( $post );
}