<?php

namespace lib\controllers;

use Exception;
use lib\models\BookingManager;
use services\Utils;
use views\View;

/**
 * Controller that manages all the pages linked with the home page
 */
class HomeController
{
    /**
     * Method to display the homepage
     *
     * @return void
     * @throws Exception
     */
    public function showHome(): void
    {
        $this->checkIfUserIsConnected();

        $bookingManager = new BookingManager();
        $bookings = $bookingManager->getBookings();

        $view = new View("Réservations");
        $view->render("home",[
            'bookings' => $bookings
        ]);
    }

    /**
     * Check if a user is connected.
     * @return void
     */
    private function checkIfUserIsConnected() : void
    {
        if (!isset($_SESSION['user'])) {
            Utils::redirect("login");
        }
    }

    /**
     * @throws Exception
     */
    public function showLogin(): void
    {
        $view = new View("Login");
        $view->render("login");
    }
}