<?php

namespace lib\models;

use DateTime;
use lib\models\AbstractEntityManager;
use PDO;

class BookingManager extends AbstractEntityManager
{
    public function getBookings(): array
    {
        $sql = "SELECT * FROM `bookings`";
        $result = $this->db->query($sql);
        $bookings = [];

        while ($booking = $result->fetch())
        {
            $bookings[] = new Booking($booking);
        }
        return $bookings;
    }

    public function updateBooking(Booking $booking): bool
    {
        $sql = "UPDATE `bookings`
                SET `room_id` = :room_id,
                    `title` = :title,
                    `start_at` = :start_at,
                    `end_at` = :end_at,
                    `participants_count` = :participants_count
                WHERE `id` = :id";
        $response = $this->db->query($sql,[
                "room_id" => $booking->getRoomId(),
                "title" => $booking->getTitle(),
                "start_at" => $booking->getStartAt()->format('Y-m-d H:i:s'),
                "end_at" => $booking->getEndAt()->format('Y-m-d H:i:s'),
                "participants_count" => $booking->getParticipantsCount(),
                "id" => $booking->getId()
            ]);
        return $response->rowCount() > 0;
    }

    public function createBooking(Booking $booking): bool
    {
        $sql = "INSERT INTO bookings (user_id, room_id, title, start_at, end_at, participants_count)
                VALUES (:user_id, :room_id, :title, :start_at, :end_at, :participants_count);";
        $response = $this->db->query($sql,[
            "user_id" => $booking->getUserId(),
            "room_id" => $booking->getRoomId(),
            "title" => $booking->getTitle(),
            "start_at" => $booking->getStartAt()->format('Y-m-d H:i:s'),
            "end_at" => $booking->getEndAt()->format('Y-m-d H:i:s'),
            "participants_count" => $booking->getParticipantsCount()
        ]);
        return $response->rowCount() > 0;
    }

    public function deleteBooking(int $id): bool
    {
        $sql = "DELETE FROM `bookings` WHERE `id` = :id";
        $response = $this->db->query($sql,["id" => $id]);
        return $response->rowCount() > 0;
    }

    public function deleteBookingsByRoomId(int $roomId): bool
    {
        $sql = "DELETE FROM `bookings` WHERE `room_id` = :room_id";
        $response = $this->db->query($sql,["room_id" => $roomId]);
        return $response->rowCount() > 0;
    }

    public function selectBetweenDatesForRoom(Booking $booking): Booking|false|null
    {
        $sql = "SELECT * FROM bookings 
                WHERE (`start_at` BETWEEN :start AND :end
                OR `end_at` BETWEEN :start AND :end
                OR :start BETWEEN `start_at` AND `end_at`
                OR :end BETWEEN `start_at` AND `end_at`)
                AND `room_id` = :room_id;";
        $response = $this->db->query($sql,[
            "room_id" => $booking->getRoomId(),
            "start" => $booking->getStartAt()->format('Y-m-d H:i:s'),
            "end" => $booking->getEndAt()->format('Y-m-d H:i:s'),
        ])
        ->fetchObject("lib\models\Booking");
        return $response ?? null;
    }

    public function findByUserId(int $userId): array
    {
        $sql = "SELECT * FROM bookings WHERE user_id = :user_id;";
        $response = $this->db->query($sql,["user_id" => $userId]);
        $bookings = [];

        while ($booking = $response->fetch())
        {
            $bookings[] = new Booking($booking);
        }
        return $bookings;
    }
}
