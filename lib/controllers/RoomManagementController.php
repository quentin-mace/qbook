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

    /**
     * Create a room, based on the form submitted in POST
     * @throws Exception
     */
    public function createRoom(): void
    {
        $room = new Room();
        $room->buildFromRequest();

        $roomManager = new RoomManager();

        $response = $roomManager->createRoom($room);
        if (!$response) {
            throw new Exception("Une erreur à eu lieu lors de votre ajout de salle. Veuillez contacter un administrateur.");
        }

        Utils::redirect("roomManagement", ["message"=>"La salle à été créée avec succès !"]);
    }
}