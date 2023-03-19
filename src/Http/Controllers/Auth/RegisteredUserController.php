<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Services\UserService;

class RegisteredUserController extends BaseController
{
    protected UserService $userService;

    public function __construct(ContainerInterface $container, UserService $userService)
    {
        parent::__construct($container);
        $this->userService = $userService;
    }

    public function create(Request $request, Response $response): Response
    {
        return $this->view($request)->render($response, 'register.html');    
    }

    public function store(Request $request, Response $response): Response
    {
        // The data we receive should always be application/x-www-form-urlencoded.
        $input = $request->getParsedBody();

        // Always validate input before submitting any information.
        $errors = $this->userService->validateRequestInput($input);
        if (count($errors) > 0) {
            return $this->view($request)->render($response, 'register.html', [
                'errors' => $errors,
            ]);   
        }

        $user = $this->userService->create($input);

        return $this->view($request)->render($response, 'register.html');        
    }
}