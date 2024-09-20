<?php

namespace lib\models;

use Exception;
use lib\controllers\HomeController;
use lib\models\AbstractEntityManager;

class UserManager extends AbstractEntityManager
{
    /**
     * @throws Exception
     */
    public function getById(int $id)
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $user = $this->db->query($sql, ['id' => $id])->fetchObject('lib\models\User');
        if(!$user){
           throw new Exception("User {$id} not found");
        }
        return $user;
    }

    /**
     * @throws Exception
     */
    public function getByEmail(string $email)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $user = $this->db->query($sql, ['email' => $email])->fetchObject('lib\models\User');
        if(!$user){
            $homeController = new HomeController();
            $homeController->showLogin("L'adresse email <strong>{$email}</strong> n'est associée à aucun compte.");
        }
        return $user;
    }
}