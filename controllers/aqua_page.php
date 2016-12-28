<?php
/**
 * Page class
 */

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
