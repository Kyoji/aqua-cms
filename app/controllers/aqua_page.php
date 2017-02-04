<?php
/**
 * Page class
 */

namespace Aqua;

class Page {
    protected $title;

    function __construct( $post )
    {
        include( 'app/templates/page.php' );
    }

    function getTitle()
    {
        return $this->title;
    }
}
