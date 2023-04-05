<?php

declare(strict_types=1);

namespace App\Services;

use Exception;
use App\Models\User;
use App\Http\Exceptions\UserNotFoundException;
use src\Repositories\TrackingRepository;

class TrackingService 
{
    /** @var App\Repositories\TrackingRepository $repository */
    private $TrackingRepository;  
    
    public function __construct(ContainerInterface $container, TrackingService $trackingService)
    {
        $this->trackingService= $trackingService;
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
}
?>