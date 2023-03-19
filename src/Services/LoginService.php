<?php

declare(strict_types=1);

namespace App\Services;

use Exception;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Http\Exceptions\UserNotFoundException;

class LoginService 
{
    /** @var App\Repositories\UserRepository $repository */
    private $userRepository;  
    
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function validateRequestInput(array $data): array
    {
        $errors = [];
        return $errors;
    }

    public function login(array $data): array
    {
        $errors = [];
        $userFound = $this->userRepository->findUserByEmail($data['email']);
        if (!$userFound) 
        {
            array_push($errors, "The requested user could not be found.");
            return $errors;
        }

        $user = new User($userFound);

        if ($this->valdiatePassword($user, $data['password']) == false)
        {
            array_push($errors, "Incorrect password. Please try again.");
            return $errors;
        }

        return $errors;
    }

    protected function valdiatePassword(User $user, string $inputPassword): bool
    {
        return password_verify($inputPassword, $user->password);
    }
}