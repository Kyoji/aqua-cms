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
    private $database;
    private $config;

    // THE only instance of the class
    private static $instance;

    //function __construct( $database, $config )
    private function __contstruct() {}
    function __init()
    {
        $this->storeURI();
        $this->database = App::getInstance()->database;
        $this->config = Config::getInstance();
        $this->route();
        echo $this->URI['current'];
    }

    protected function storeURI() {
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

    /**
     * 1. Router reads uri
     * 2.
     */
    protected function route()
    {   
        $database = $this->database;
        $config = $this->config;
        $routeFound = false;

        if( $this->URI['isRoot'] ) {
            if( null !== $config->getRoute("root") ) {
                include($config->getRoute("root"));
            } else {
                $posts = $database->getPosts();
                foreach( $posts as $post ) {
                    include( 'app/templates/partials/post.php' );
                }
            }
        } else {
            $post = $database->getPostBy('post_slug', $this->URI['current']);
            if( count($post) > 0 ) {
                $page = new Page($post[0]);
            } else {
                $path = 'app';
                $files = array_diff(scandir($path), array('.', '..'));
                foreach( $files as $file ) {
                    if($file === $this->URI['current'].".php") {
                        include('app/' . $file);
                        $routeFound = true;
                        break;
                    }
                }
                if( !$routeFound )
                    include( $config->getRoute("404") );

            }

        }
    }

    function registerSlug( $slug, $entity )
    {
        // Add registered slug to end of array
        $this->registered_slugs[$slug] = $entity;
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