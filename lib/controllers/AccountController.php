<?php

namespace lib\controllers;

use Exception;
use lib\models\BookingManager;
use lib\models\UserManager;
use services\Utils;
use views\View;

class AccountController
{
    /**
     * @throws Exception
     */
    public function showAccount(string $infoMessage = null, string $errorMessage = null): void
    {
        $bookingManager = new BookingManager();
        $bookings = $bookingManager->findByUserId($_SESSION["user"]["id"]);

        $userManager = new UserManager();
        $user = $userManager->getById($_SESSION["user"]["id"]);

        $view = new View("Mon Compte");
        $view->render("account", [
            "bookings" => $bookings,
            "user" => $user,
        ]);
    }
}