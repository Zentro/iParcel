<?php

declare(strict_types=1);

use Slim\App;
use App\Http\Controllers\HomeController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->get('/', HomeController::class . ':actionIndex');

    // /login
    // /register
    // /forgot-password
    // /reset-password
    // /verify-email/{id}/{hash}
    // /logout
};