<?php

namespace lib\controllers;

use Exception;
use lib\models\BookingManager;
use lib\models\RoomManager;
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

        $userManager = new UserManager();
        $user = $userManager->getById($_SESSION["user"]);

        $roomManager = new RoomManager();
        $rooms = $roomManager->getAll();

        //Utils::betterDump($_REQUEST);

        $view = new View("Réservations");
        $view->render("home",[
            'bookings' => $bookings,
            'infoMessage' => $infoMessage,
            'user' => $user,
            'rooms' => $rooms
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
            Utils::redirect("showLogin",[
                "message" => "Email ou mot de passe non remplis.",
                "email" => $email
            ]);
        }

        $userManager = new UserManager();
        $user = $userManager->getByEmail($email);

        if(!$user){
            Utils::redirect("showLogin",[
                "message" => "L'adresse email <strong>{$email}</strong> n'est associée à aucun compte."
            ]);
        }

        if(!password_verify($password, $user->getPassword())){
            $this->showLogin("Mot de passe incorrect.");
            Utils::redirect("showLogin",[
                "message" => "Mot de passe incorrect.",
                "email" => $email
            ]);
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
            exit();
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
        $view = new View("Connexion");
        if(isset($errorMessage)){
            $view->render(
                "login",
                [
                    "errorMessage" => $errorMessage
                ]
            );
        } else {
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
        $view = new View("Créer un compte");
        if(isset($errorMessage)){
            $view->render(
                "signin",
                [
                    "errorMessage" => $errorMessage
                ]
            );
        } else {
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
            Utils::redirect("showSignin",[
                "message" => "Certains champs sont vides.",
                "name" => $name,
                "email" => $email
            ]);

        }

        if($password != $confirmPassword){
            Utils::redirect("showSignin",[
                "message" => "Les mots de passe ne correspondent pas.",
                "name" => $name,
                "email" => $email
            ]);
        }

        $userManager = new UserManager();
        if($userManager->getByEmail($email)){
            Utils::redirect("showSignin",[
                "message" => "Cette adresse email est déja associée à un compte !",
                "name" => $name
            ]);
        }

        $user = new User();
        $user->setName($name);
        $user->setEmail($email);
        $user->setPassword(password_hash($password, PASSWORD_DEFAULT));

        $result = $userManager->addUser($user);

        if (!$result) {
            Utils::redirect("showSignin",[
                "message" => "Création du compte impossible. Contactez l'administrateur.",
                "name" => $name,
                "email" => $email
            ]);
        }

        $user = $userManager->getByEmail($email);
        $_SESSION["user"] = $user->getId();

        Utils::redirect("home", ["message" => "Votre compte à bien été créé ! Bienvenue {$name} !"]);
        exit();
    }
}