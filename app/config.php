<?php

declare(strict_types=1);

use App\Config;
use Dotenv\Dotenv;
use DI\ContainerBuilder;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        'config' => [
            'displayErrorDetails' => true, // Should be set to false in production
            'logError'            => false,
            'logErrorDetails'     => false,
            'database' => [
                'host'            => $_ENV['DB_HOST'],
                'port'            => $_ENV['DB_PORT'],
                'database'        => $_ENV['DB_DATABASE'],
                'username'        => $_ENV['DB_USERNAME'],
                'password'        => $_ENV['DB_PASSWORD'],
            ],
        ],
    ]);
};