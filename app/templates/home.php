<?php
/**
 * Homepage for Aqua
 */

$router = \Aqua\Router::getInstance()->URI;
//print_r($router);
?>

<h1>This is home</h1>

<form method="post" action="login">
    <input type="text" name="username">
    <input type="text" name="password">
    <button type="submit">Login</button>
</form>
