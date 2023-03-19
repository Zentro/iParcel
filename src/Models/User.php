<?php

declare(strict_types=1);

namespace App\Models;

use Ramsey\Uuid\Uuid;

class User 
{
    public string $user_id;
    public ?int $user_group_id;
    public ?int $user_group_role_id;
    public ?string $email;
    public string $name;
    public string $password;
    public string $phone;

    public function __construct($fields) 
    {
        $this->email = $fields['email'];
        $this->name = $fields['name'];
        $this->password = $fields['password'];
        $this->phone = $fields['phone'];
        $this->user_group_id = isset($fields['user_group_id']) ? $fields['user_group_id'] : 0;
        $this->user_group_role_id = isset($fields['user_group_id']) ? $fields['user_group_id'] : 0;
    }

    public function getUserId(): string
    {
        return $this->user_id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function generateUuid(): string
    {
        $uuid = Uuid::uuid4();
        return $uuid->toString();
    }

    public function _toArray(): array
    {
        return [
            'user_id' => $this->user_id,
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'phone' => $this->phone,
            'user_group_id' => $this->user_group_id,
            'user_group_role_id' => $this->user_group_role_id
        ];
    }
}