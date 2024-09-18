<?php

namespace lib\models;


use Exception;
use lib\models\AbstractEntityManager;

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
}