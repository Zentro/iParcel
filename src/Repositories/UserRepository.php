<?php

declare(strict_types=1);

namespace App\Repositories;

use PDO;
use App\Models\User;

class UserRepository
{
    private $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function findAll()
    {
        $stmt = $this->conn->prepare("SELECT * FROM users");
        $stmt->execute();
    }

    public function findUserById($userId)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id=:id");
        $stmt->bindParam(':id', $userId);
        $stmt->execute();

        // fetch data and bind to user model
    }

    public function findUserByEmail($email): array
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email=:email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result[0];
    }

    public function findUserByPhone($phone)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE phone=:phone");
        $stmt->bindParam(':phone', $phone);
        $stmt->execute();
    }

    public function create(User $user): User
    {
        $stmt = $this->conn->prepare("INSERT INTO users 
            (user_id, name, email, password, phone, user_group_id, user_group_role_id) 
            VALUES (:user_id,:name,:email,:password,:phone,:user_group_id,:user_group_role_id)");
        $stmt->execute($user->_toArray());
        return $user;
    }
}