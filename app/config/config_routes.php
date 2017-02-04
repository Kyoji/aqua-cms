<?php
/**
 * Routes config file
 * Called by \Aqua\Config->__init()
 *
 * @since 0.1
 * @author Daniel Owens
 */

$this->setRoute("root", $this->templatesDir."/home.php");
$this->setRoute("404", $this->templatesDir."/404.php");