<?php

namespace lib\controllers;

use Exception;
use lib\models\BookingManager;
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
        $bookingManager = new BookingManager();
        $bookings = $bookingManager->getBookings();

        $view = new View("Réservations");
        $view->render("home",[
            'bookings' => $bookings
        ]);
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