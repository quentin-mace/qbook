<?php

namespace lib\models;

use lib\models\AbstractEntityManager;

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
}