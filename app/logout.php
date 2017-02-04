<?php

namespace Aqua;
$session = \Aqua\Session::getInstance();

if( $session->__get( "logged_in" ) ) {
    $session->__set( "logged_in", false );
    echo "You are now logged out";
    ?>
    <a href="/">Return home</a>
    <?php
}