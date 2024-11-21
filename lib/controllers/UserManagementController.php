<?php

namespace lib\controllers;

use Exception;
use lib\models\Booking;
use lib\models\BookingManager;
use lib\models\Room;
use lib\models\RoomManager;
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
}
