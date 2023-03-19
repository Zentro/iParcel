<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Services\LoginService;
use Psr\Container\ContainerInterface;
use App\Http\Controllers\BaseController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AuthenticatedSessionController extends BaseController
{
    protected LoginService $loginService;

    public function __construct(ContainerInterface $container, LoginService $loginService)
    {
        parent::__construct($container);
        $this->loginService = $loginService;
    }

    public function create(Request $request, Response $response): Response
    {
        return $this->view($request)->render($response, 'login.html'); 
    }

    public function store(Request $request, Response $response)
    {
        // It's especially critial here everything is application/x-www-form-urlencoded.
        $input = $request->getParsedBody();

        $errors = $this->loginService->login($input);
        if (!empty($errors))
        {
            return $this->view($request)->render($response, 'login.html', [
                'errors' => $errors,
            ]);
        }

        return $this->redirect($response, '/dashboard');
    }

    public function destroy(Request $request, Response $response): Response
    {
        return $this->view($request)->render($response, 'logout.html');        
    }
}