<?php

namespace lib\models;

use Exception;
use lib\models\AbstractEntityManager;

class UserManager extends AbstractEntityManager
{
    public function getById(int $id)
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $user = $this->db->query($sql, ['id' => $id])->fetchObject('lib\models\User');
        if(!$user){
           throw new Exception("User {$id} not found");
        }
        return $user;
    }
}