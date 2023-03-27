<?php

declare(strict_types=1);

use Slim\App;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\SupportController;
use Psr\Http\Message\ResponseInterface as Response;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\User\DashboardController;

return function (App $app) {
    $app->get('/', HomeController::class . ':create');

    $app->get('/login', AuthenticatedSessionController::class . ':create');
    $app->post('/login', AuthenticatedSessionController::class . ':store');
    $app->post('/logout', AuthenticatedSessionController::class . ':destroy');
    $app->get('/register', RegisteredUserController::class . ':create');
    $app->post('/register', RegisteredUserController::class . ':store');
    $app->get('/reset-password', PasswordResetController::class . ':create');
    $app->post('/reset-password', PasswordResetController::class . ':store');
    $app->post('/verify-email/{id}/{hash}', VerifyEmailController::class . ':store');

    $app->get('/dashboard', DashboardController::class . ':create');

    $app->get('/tracking', TrackingController::class . ':create');

    $app->get('/support', SupportController::class . ':create');

    $app->get('/about', AboutController::class . ':create');
};