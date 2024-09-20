<?php

namespace lib\controllers;

use Exception;
use lib\models\BookingManager;
use lib\models\UserManager;
use services\Utils;
use views\View;

/**
 * Controller that manages all the pages linked with the home page
 */
class HomeController
{
    /**
     * Displays the homepage.
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
     * Check the connexion information and either redirect on the login page or connect the user and redirect to homepage.
     * @throws Exception
     */
    public function confirmLogin(): void
    {
        $email = Utils::request("email");
        $password = Utils::request("password");

        if(!$email || !$password){
            throw new Exception("Email ou mot de passe non remplis.");
        }

        $userManager = new UserManager();
        $user = $userManager->getByEmail($email);

        if(!password_verify($password, $user->getPassword())){
            throw new Exception("Mot de passe incorrect.");
        }

        $_SESSION["user"] = $user->getId();

        Utils::redirect('home');
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
     * Displays the login page.
     * @throws Exception
     */
    public function showLogin(): void
    {
        $view = new View("Login");
        $view->render("login");
    }
}