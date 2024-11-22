<?php

namespace lib\controllers;

use Exception;
use lib\models\Booking;
use lib\models\BookingManager;
use lib\models\Room;
use lib\models\RoomManager;
use lib\models\User;
use lib\models\UserManager;
use services\Utils;
use views\View;

class UserManagementController
{
    /**
     * @throws Exception
     */
    public function showUserManagement(string $infoMessage = null, string $errorMessage = null): void
    {
        $userManager = new UserManager();
        $users = $userManager->getAll();

        $view = new View("Utilisateurs");
        $view->render("users",[
            'infoMessage' => $infoMessage,
            'errorMessage' => $errorMessage,
            'users' => $users
        ]);
    }

    /**
     * @throws Exception
     */
    private function updateUser(User $user): void
    {
        $userManager = new UserManager();
        $response = $userManager->updateUser($user);

        if (!$response) {
            throw new Exception("Une erreur à eu lieu lors de la mise à jour. Veuillez contacter un administrateur.");
        }
    }

    /**
     * @throws Exception
     */
    public function upgradeUser(): void
    {
        $userManager = new UserManager();
        $user = $userManager->getById(Utils::request("id"));
        $user->setRoleId(UserManager::ROLE_ADMIN);
        $this->updateUser($user);

        Utils::redirect("userManagement", ["message"=>"L'utilisateur à été mis à jour avec succès !"]);
    }

    /**
    * @throws Exception
    */
    public function downgradeUser(): void
    {
        $userManager = new UserManager();
        $user = $userManager->getById(Utils::request("id"));
        $user->setRoleId(UserManager::ROLE_BASIC_USER);
        $this->updateUser($user);

        $currentUser = $userManager->getById($_SESSION["user"]["id"]);
        if($currentUser->getId() === $user->getId()) {
            Utils::stockUserSession($currentUser);
            Utils::redirect("home", ["message"=>"L'utilisateur à été mis à jour avec succès !"]);
        }

        Utils::redirect("userManagement", ["message"=>"L'utilisateur à été mis à jour avec succès !"]);
    }
}
