<?php

namespace lib\controllers;

use Exception;
use lib\models\BookingManager;
use lib\models\User;
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
    public function showHome(string $infoMessage = null): void
    {
        $this->checkIfUserIsConnected();

        $bookingManager = new BookingManager();
        $bookings = $bookingManager->getBookings();

        $view = new View("Réservations");
        $view->render("home",[
            'bookings' => $bookings,
            'infoMessage' => $infoMessage,
        ]);
    }

    /**
     * Check the connexion information and either redirect on the login page
     * or connect the user and redirect to homepage.
     * @throws Exception
     */
    public function confirmLogin(): void
    {
        $email = Utils::request("email");
        $password = Utils::request("password");

        if(!$email || !$password){
            $this->showLogin("Email ou mot de passe non remplis.");
        }

        $userManager = new UserManager();
        $user = $userManager->getByEmail($email);

        if(!$user){
            $homeController = new HomeController();
            $homeController->showLogin("L'adresse email <strong>{$email}</strong> n'est associée à aucun compte.");
        }

        if(!password_verify($password, $user->getPassword())){
            $this->showLogin("Mot de passe incorrect.");
        }

        $_SESSION["user"] = $user->getId();

        Utils::redirect('home');
    }

    /**
     * Logs of the user and redirect to the homepage
     * @return void
     */
    public function logOff(): void
    {
        unset($_SESSION["user"]);
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
     * @param string|null $errorMessage Optional error message to display as an alert.
     * @return void
     * @throws Exception
     */
    public function showLogin(string $errorMessage = null): void
    {
        if(isset($errorMessage)){
            $view = new View("Connexion");
            $view->render(
                "login",
                [
                    "errorMessage" => $errorMessage
                ]
            );
        } else {
            $view = new View("Connexion");
            $view->render("login");
        }
    }

    /**
     * Displays the sign-in page.
     * @param string|null $errorMessage Optional error message to display as an alert.
     * @return void
     * @throws Exception
     */
    public function showSignin(string $errorMessage = null): void
    {
        if(isset($errorMessage)){
            $view = new View("Créer un compte");
            $view->render(
                "signin",
                [
                    "errorMessage" => $errorMessage
                ]
            );
        } else {
            $view = new View("Créer un compte");
            $view->render("signin");
        }
        exit();
    }

    /**
     * Check the connexion information and either redirect on the signin page
     * or connect the user and redirect to homepage.
     * @throws Exception
     */
    public function confirmSignin(): void
    {
        $name = htmlspecialchars(Utils::request("name"));
        $email = Utils::request("email");
        $password = htmlspecialchars(Utils::request("password"));
        $confirmPassword = htmlspecialchars(Utils::request("confirmPassword"));

        if(
            !$name ||
            !$email ||
            !$password ||
            !$confirmPassword
        ){
            $this->showSignin("Certains champs sont vides.");
        }

        if($password != $confirmPassword){
            $this->showSignin("Les mots de passe ne correspondent pas.");
        }

        $userManager = new UserManager();
        if($userManager->getByEmail($email)){
            $this->showSignin("Cette adresse email est déja associée à un compte !");
        }

        $user = new User();
        $user->setName($name);
        $user->setEmail($email);
        $user->setPassword(password_hash($password, PASSWORD_DEFAULT));

        $result = $userManager->addUser($user);

        if (!$result) {
            $this->showSignin("Création du compte impossible. Contactez l'administrateur.");
        }

        $user = $userManager->getByEmail($email);
        $_SESSION["user"] = $user->getId();

        $this->showHome("Votre compte à bien été créé ! Bienvenue {$name} !");
    }
}