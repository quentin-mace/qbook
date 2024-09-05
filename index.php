<?php
use config\Autoloader;
use lib\controllers\HomeController;

require "config/config.php";
require "config/Autoloader.php";

Autoloader::register();

$action = "home";

$parameters = $_GET;

if(isset($parameters["action"])){
    $action = $parameters["action"];
}

switch ($action) {
    case "home":
        $homeController = new HomeController();
        $homeController->showHome();
        break;
    default:
        $homeController = new HomeController();
        $homeController->showError();
        break;
}
