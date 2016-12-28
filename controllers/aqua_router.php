<?php
/**
 * Routing class for Aqua
 */
namespace Aqua;

class Router {

    public $URI = [
        'raw' => '',
        'list' => '',
        'list_reverse' => '',
        'current' => '',
        'isRoot' => NULL,
    ];

    public $registered_slugs = [];

    function __construct( $database, $config )
    {
        $this->populateURI();
        $this->route( $database, $config );
    }

    protected function populateURI() {
        $URI = &$this->URI;
        if ( $_SERVER['REQUEST_URI'] != "/" ) {
            $raw = trim( $_SERVER['REQUEST_URI'], '/');
            $list = explode( '/', $raw );
            $list_reverse = array_reverse( $list );
            $current = htmlspecialchars($list_reverse[0]);
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

    protected function route( $database, $config )
    {
        if( $this->URI['isRoot'] ) {
            if( null !== $config->getRoute("root") ) {
                include($config->getRoute("root"));
            } else {
                $posts = $database->getPosts();
                foreach( $posts as $post ) {
                    include( 'templates/partials/post.php' );
                }
            }
        } else {
            $post = $database->getPostBy('post_slug', $this->URI['current']);
            if( \count($post) > 0 ) {
                $page = new Page($post[0]);
            } else {
                include( $config->getRoute("404") );
            }

        }
    }

    function registerSlug( $slug, $entity )
    {
        // Add registered slug to end of array
        $this->registered_slugs[$slug] = $entity;
    }

}