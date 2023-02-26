<?php

declare(strict_types=1);

namespace App\Repositories;

use PDO;

class UserRepository
{
    private $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }
}