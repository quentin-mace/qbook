<?php

namespace lib\models;


use Exception;
use lib\models\AbstractEntityManager;
use PDO;
use services\Utils;

class RoomManager extends AbstractEntityManager
{
    /**
     * @throws Exception
     */
    public function getById(int $id) : Room
    {
        $sql = "SELECT * FROM rooms WHERE id = :id";
        $room = $this->db->query($sql, ["id" => $id])->fetchObject('lib\models\Room');
        if(!$room){
            throw new Exception("Room {$id} not found");
        }
        return $room;
    }

    /**
     * @throws Exception
     */
    public function getByName(string $name) : Room|false|null
    {
        $sql = "SELECT * FROM rooms WHERE name = :name";
        $room = $this->db->query($sql, ["name" => $name])->fetchObject('lib\models\Room');
        return $room;
    }

    /**
     * @throws Exception
     */
    public function getAll() : array
    {
        $sql = "SELECT * FROM rooms";
        $rooms = $this->db->query($sql)->fetchAll(PDO::FETCH_CLASS, 'lib\models\Room');
        if(!$rooms){
            throw new Exception("No rooms found");
        }
        return $rooms;
    }


    public function createRoom(Room $room): bool
    {
        $sql = "INSERT INTO rooms (name, place, capacity)
                VALUES (:name, :place, :capacity);";
        $response = $this->db->query($sql,[
            "name" => $room->getName(),
            "place" => $room->getPlace(),
            "capacity" => $room->getCapacity()
        ]);
        return $response->rowCount() > 0;
    }

    public function updateRoom(Room $room): bool
    {
        $sql = "UPDATE `rooms`
                SET `name` = :name,
                    `place` = :place,
                    `capacity` = :capacity
                WHERE `id` = :id";
        $response = $this->db->query($sql,[
            "name" => $room->getName(),
            "place" => $room->getPlace(),
            "capacity" => $room->getCapacity(),
            "id" => $room->getId()
        ]);
        return $response->rowCount() > 0;
    }

    public function deleteRoom(int $id): bool
    {
        $sql = "DELETE FROM `rooms` WHERE `id` = :id";
        $response = $this->db->query($sql,["id" => $id]);
        return $response->rowCount() > 0;
    }
}
