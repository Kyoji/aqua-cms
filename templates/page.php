<?php
/**
 * Created by PhpStorm.
 * User: danielowens
 * Date: 11/20/16
 * Time: 12:23 AM
 */

?>

<?php

    echo '<h1>Welcome to '.$post->title.'!</h1>';
    echo '<h3>'.$post->subtitle.'</h3>';
    foreach ( $URI['list'] as $link ) {
        $s = $_SERVER['HTTP_HOST'];
        echo ' / <a href="http://' . $s . '/' . $link . '">' . $link . '</a>';


    }
    echo '<p>'.$post->content.'</p>';

?>

<?php //foreach ( $posts as $page ) {
//
//    echo '<h1>Welcome to '.$page->title.'!</h1>';
//    echo '<h3>'.$page->subtitle.'</h3>';
//    foreach ( $URI['list'] as $link ) {
//        $s = $_SERVER['HTTP_HOST'];
//        echo ' / <a href="http://' . $s . '/' . $link . '">' . $link . '</a>';
//
//
//    }
//    echo '<p>'.$page->content.'</p>';
//} ?>