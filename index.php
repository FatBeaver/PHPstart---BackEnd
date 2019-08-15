<?php 

//  FRONT CONTROLLER

// 1. GENERAL SETTINGS

ini_set('display_errors', 1);
error_reporting(E_ALL);

// 2. INCLUDING FILES

require_once (__DIR__ . '/components/Router.php');
require_once (__DIR__ . '/components/Db.php');

// 3. DB CONNECTION


// 4. CALLING ROUTER
$router = new Router();
$router->run();