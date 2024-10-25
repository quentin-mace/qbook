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
            return null;
        }
        return $user;
    }

    public function addUser(User $user): bool
    {
        $sql = "INSERT INTO users (name, email, password, role_id) VALUES (:name, :email, :password, 1)";
        $response = $this
            ->db
            ->query($sql, [
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => $user->getPassword()
            ]);
        return $response->rowCount() > 0;
    }

    public function updateUser(User $user): bool
    {
        $sql = "UPDATE users SET name = :name, email = :email WHERE id = :id";
        $response = $this
            ->db
            ->query($sql, [
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'id' => $user->getId()
            ]);
        return $response->rowCount() > 0;
    }
}