<?php 

//  FRONT CONTROLLER

// 1. GENERAL SETTINGS

ini_set('display_errors', 1);
error_reporting(E_ALL);

// 2. INCLUDING FILES
define('ROOT', __DIR__);  

require_once (__DIR__ . '/components/Autoload.php');

// 3. CALLING ROUTER
$router = new Router();
$router->run();