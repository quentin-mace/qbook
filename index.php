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
$message = null;
$parameters = null;

if(isset($_SESSION['post_data'])){
    $parameters = $_SESSION['post_data'];
    unset($_SESSION['post_data']);
}

if(isset($_GET["action"])){
    $action = $_GET["action"];
}
if(isset($parameters["message"])){
    $message = $parameters["message"];
}


// We call the proper controller depending on which action is passed

try {
    switch ($action) {
        case "home":
            $homeController = new HomeController();
            $homeController->showHome($message);
            break;
        case "login":
            $homeController = new HomeController();
            $homeController->showLogin($message);
            break;
        case "confirmLogin":
            $homeController = new HomeController();
            $homeController->confirmLogin();
            break;
        case "logoff":
            $homeController = new HomeController();
            $homeController->logOff();
            break;
        case "signin":
            $homeController = new HomeController();
            $homeController->showSignin($message);
            break;
        case "confirmSignin":
            $homeController = new HomeController();
            $homeController->confirmSignin();
            break;
        case "updateBooking":
            $homeController = new HomeController();
            $homeController->updateBooking();
            break;
        case "createBooking":
            $homeController = new HomeController();
            $homeController->createBooking();
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
