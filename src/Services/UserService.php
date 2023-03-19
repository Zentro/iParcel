<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;

class UserService
{
    /** @var App\Repositories\UserRepository $repository */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAll()
    {

    }

    public function get($userId)
    {

    }

    public function create($fields): User
    {
        $user = new User($fields);
        $user->user_id = $user->generateUuid();
        $user->password = password_hash($user->password, PASSWORD_DEFAULT);

        $user = $this->userRepository->create($user);
        return $user;
    }

    public function update($userid)
    {

    }

    public function delete($userId)
    {

    }

    public function validateRequestInput(array $data): array
    {
        $errors = [];
        if ($data['password'] != $data['repeat_password']) {
            array_push($errors, "Passwords do not match.");
        }

        if (strlen($data['password']) < 8) {
            array_push($errors, "Password length must be at least 8 characters.");
        }
        return $errors;
    }

    private function getRequestedUser($userId)
    {

    }
}