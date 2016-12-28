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


$route = new Router();
$route->registerSlug( 'posts', 'Aqua\Post' );
$database = new MySQLDatabase();

if( $route->URI['isRoot'] ) {
    $posts = $database->getPosts();
    foreach ( $posts as $post ) {
        echo $post->post_name;
    }
} else {
    $posts = $database->getPostBy('post_slug', $route->URI['current']);
    foreach ( $posts as $post ) {
        echo $post->post_name;
    }
}

//$page = new Page( $posts );
//echo $route->getCurrentDir();
//$page = new Page( $route->URI );

//$pdo = new AquaPDO();
//$foo_slug = 'foo';

// $stmt = $pdo->prepare('SELECT * FROM posts WHERE slug = :foo_slug');
// $stmt->execute(['foo_slug' => $route->URI['current']]);


