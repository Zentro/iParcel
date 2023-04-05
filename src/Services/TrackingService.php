<?php

declare(strict_types=1);

namespace App\Services;

use Exception;
use App\Models\User;
use App\Http\Exceptions\UserNotFoundException;
use App\Repositories\TrackingRepository;

class TrackingService 
{
    /** @var App\Repositories\TrackingRepository $repository */
    private $TrackingRepository; 
   
    public function __construct(UserRepository $TrackingRepository)
    {
        $this->TrackingRepository = $TrackingRepository;
    }
    
    public function findParcelStatus($userId)
    {   
        $errors = [];
        $parcelFound = $this->TrackingRepository->findParcelById($userId);
        if (!$parcelFound) 
        {
            array_push($errors, "The requested user could not be found.");
            return $errors;
        }
        else{
            return $parcelFound;
        }
    }

}
?>