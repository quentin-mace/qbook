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

        $this->sameNameRoomExists($room);

        $roomManager = new RoomManager();

        $response = $roomManager->createRoom($room);
        if (!$response) {
            throw new Exception("Une erreur à eu lieu lors de votre ajout de salle. Veuillez contacter un administrateur.");
        }

        Utils::redirect("roomManagement", ["message"=>"La salle à été créée avec succès !"]);
    }

    /**
     * Deletes a room
     * @throws Exception
     */
    public function deleteRoom(): void
    {
        $roomId = Utils::request("id");
        $roomManager = new RoomManager();
        $result = $roomManager->deleteRoom($roomId );

        if (!$result) {
            throw new Exception("Une erreur à eu lieu lors de la suppression de la salle. Veuillez contacter un administrateur.");
        }

        $bookingManager = new BookingManager();
        $result = $bookingManager->deleteBookingsByRoomId($roomId);

        if (!$result) {
            throw new Exception("Une erreur à eu lieu lors de la suppression de la salle. Veuillez contacter un administrateur.");
        }

        Utils::redirect("roomManagement", [
            "message" => "La salle à bien été supprimée"
        ]);
    }

    /**
     * Updates a room
     * @throws Exception
     */
    public function updateRoom(): void
    {
        $room = new Room();
        $room->setId(Utils::request("id"));
        $room->buildFromRequest();

        $this->sameNameRoomExists($room);

        $roomManager = new RoomManager();
        $response = $roomManager->updateRoom($room);

        if (!$response) {
            throw new Exception("Une erreur à eu lieu lors de la mise à jour. Veuillez contacter un administrateur.");
        }

        Utils::redirect("roomManagement", ["message"=>"La salle à été mise à jour avec succès !"]);

    }

    /**
     * @throws Exception
     */
    private function sameNameRoomExists(Room $room): void
    {
        $roomManager = new RoomManager();
        $sameNameRoom = $roomManager->getByName($room->getName());
        if($sameNameRoom && $sameNameRoom->getId() !== $room->getId()) {
            Utils::redirect("roomManagement", ["error"=>"Impossible de modifier la salle. Une autre salle existe déja à ce nom"]);
        }
    }
}
