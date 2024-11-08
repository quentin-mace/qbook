<?php

namespace lib\controllers;

use Exception;
use lib\models\BookingManager;
use lib\models\RoomManager;
use lib\models\UserManager;
use views\View;

class RoomManagementController
{
    /**
     * @throws Exception
     */
    public function showRoomManagement(string $infoMessage = null, string $errorMessage = null): void
    {
        $roomManager = new RoomManager();
        $rooms = $roomManager->getAll();

        $view = new View("Salles");
        $view->render("rooms",[
            'infoMessage' => $infoMessage,
            'errorMessage' => $errorMessage,
            'rooms' => $rooms
        ]);
    }
}