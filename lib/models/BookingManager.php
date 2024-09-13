<?php

namespace lib\models;

use lib\models\AbstractEntityManager;

class BookingManager extends AbstractEntityManager
{
    public function getBookings()
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
}