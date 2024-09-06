<?php
use config\Autoloader;
use lib\controllers\ErrorController;
use lib\controllers\HomeController;

// We import the config and autoloader.

require "config/config.php";
require "config/Autoloader.php";

Autoloader::register();

// We get which action is asked

$action = "home";

$parameters = $_GET;

if(isset($parameters["action"])){
    $action = $parameters["action"];
}


// We call the proper controller depending on which action is passed

try {
    switch ($action) {
        case "home":
            $homeController = new HomeController();
            $homeController->showHome();
            break;
        default:
            $errorController = new ErrorController();
            $errorController->show404();
            break;
    }
} catch (Exception $e) {
    // If an exception is thrown, we display an error page.

    $errorController = new ErrorController();
    $errorController->showException($e->getMessage());
}
