<?php
/**
 * Views controller for Aqua
 *
 * @since 0.1
 * @author Daniel Owens
 */

namespace Aqua;

class View {
    // THE only instance of the class
    private static $instance;



    public static function getInstance()
    {
        if ( !isset(self::$instance))
        {
            self::$instance = new self();
        }

        return self::$instance;
    }
}