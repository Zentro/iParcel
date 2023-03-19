<?php

declare(strict_types=1);

namespace App\Http\Exceptions;

use Exception;

class UserNotFoundException extends Exception
{
    public $message = 'The requested user could not be found.';
}