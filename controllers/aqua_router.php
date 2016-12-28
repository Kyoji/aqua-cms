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