<?php
/**
 * Config for Aqua app
 *
 * @since 0.1
 * @author Daniel Owens
 */

include( 'controllers/aqua_config.php' );

$aquaConfig = new AquaConfig();
$dbValues = [
    'host' => 'localhost',
    'db' => 'aqua',
    'user' => 'root',
    'pass' => '',
    'charset' => 'utf8mb4'
];
$aquaConfig->setDBConfig( $dbValues );
$aquaConfig->setRoute("root", $aquaConfig->templatesDir."/home.php");
$aquaConfig->setRoute("404", $aquaConfig->templatesDir."/404.php");
//print_r($aquaConfig->getDBConfig());
