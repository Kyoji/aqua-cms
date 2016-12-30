<?php
/**
 * Page class
 */

namespace Aqua;

class Page {
    protected $title;

    function __construct( $post )
    {
        include( 'templates/page.php' );
    }

    function getTitle()
    {
        return $this->title;
    }
}
