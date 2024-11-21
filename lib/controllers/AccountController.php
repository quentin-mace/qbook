<?php

namespace lib\controllers;

use Exception;
use lib\models\BookingManager;
use lib\models\RoomManager;
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

        $roomManager = new RoomManager();
        $rooms = $roomManager->getAll();

        $view = new View("Mon Compte");
        $view->render("account", [
            "bookings" => $bookings,
            "user" => $user,
            "infoMessage" => $infoMessage,
            "errorMessage" => $errorMessage,
            "rooms" => $rooms
        ]);
    }


    /**
     * @throws Exception
     */
    public function showUpdateAccount(string $infoMessage = null, string $errorMessage = null): void
    {
        $userManager = new UserManager();
        $user = $userManager->getById($_SESSION["user"]["id"]);

        $view = new View("Mon Compte");
        $view->render("updateAccount", [
            "user" => $user,
            "infoMessage" => $infoMessage,
            "errorMessage" => $errorMessage,
        ]);
    }

    /**
     * @throws Exception
     */
    public function updateAccountInfo(): void
    {
        $name = Utils::request("name");
        $email = Utils::request("email");

        if (!$name || !$email) {
            Utils::redirect("updateAccount", ["error" => "Certains champs sont vides"]);
        }

        $userManager = new UserManager();
        $sameEmailAccount = $userManager->getByEmail($email);
        if ($sameEmailAccount && $sameEmailAccount->getId() !== $_SESSION["user"]["id"]) {
            Utils::redirect("updateAccount", ["error" => "Cet email est déja utilisé par un autre compte"]);
        }

        $user = $userManager->getById($_SESSION["user"]["id"]);
        $user->setName($name);
        $user->setEmail($email);

        $response = $userManager->updateUser($user);
        if (!$response) {
            throw new Exception("Une erreur à eu lieu lors de la sauvegarde. Veuillez contacter un administrateur.");
        }

        Utils::stockUserSession($user);

        Utils::redirect("updateAccount", ["message" => "Votre compte à bien été modifié."]);
    }

    /**
     * @throws Exception
     */
    public function updatePassword(): void
    {
        $oldPassword = Utils::request("oldPassword");
        $newPassword = Utils::request("newPassword");
        $confirmPassword = Utils::request("confirmPassword");

        if (!$oldPassword || !$newPassword || !$confirmPassword) {
            Utils::redirect("updateAccount", ["error" => "Certains champs sont vides"]);
        }

        $userManager = new UserManager();
        $userId = $_SESSION["user"]["id"];
        $user = $userManager->getById($userId);

        if(!password_verify($oldPassword, $user->getPassword())){
            Utils::redirect("updateAccount", ["error" => "Ancien mot de passe incorrect."]);
        }

        if ($newPassword !== $confirmPassword) {
            Utils::redirect("updateAccount", ["error" => "Les mots de passe ne correspondent pas"]);
        }

        $user->setPassword(password_hash($newPassword, PASSWORD_DEFAULT));

        $response = $userManager->updateUser($user);
        if (!$response) {
            throw new Exception("Modification du mot de passe impossible. Contactez l'administrateur.");
        }

        Utils::stockUserSession($user);

        Utils::redirect("updateAccount", ["message" => "Votre mot de passe à bien été modifié."]);
    }
}
