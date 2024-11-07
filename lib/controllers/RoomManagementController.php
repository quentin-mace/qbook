<?php

namespace lib\controllers;

use lib\models\BookingManager;
use lib\models\RoomManager;
use lib\models\UserManager;
use views\View;

class RoomManagementController
{
    public function showRoomManagement(string $infoMessage = null, string $errorMessage = null): void
    {
        $bookingManager = new BookingManager();
        $bookings = $bookingManager->getBookings();

        $userManager = new UserManager();
        $user = $userManager->getById($_SESSION["user"]["id"]);

        $roomManager = new RoomManager();
        $rooms = $roomManager->getAll();

        $view = new View("Salles");
        $view->render("rooms",[
            'bookings' => $bookings,
            'infoMessage' => $infoMessage,
            'errorMessage' => $errorMessage,
            'user' => $user,
            'rooms' => $rooms
        ]);
    }
}