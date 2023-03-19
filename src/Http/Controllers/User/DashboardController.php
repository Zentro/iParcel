<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class DashboardController extends BaseController
{
    public function create(Request $request, Response $response): Response
    {
        return $this->view($request)->render($response, 'dashboard.html');        
    }
}