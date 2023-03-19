<?php

declare(strict_types=1);

use Dotenv\Dotenv;
use DI\ContainerBuilder;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        'config' => [
            'displayErrorDetails' => getenv('APP_DEBUG') === 'true' ? true : false,
            'logError'            => false,
            'logErrorDetails'     => false,
            'database' => [
                'host'            => $_ENV['DB_HOST'],
                'database'        => $_ENV['DB_DATABASE'],
                'username'        => $_ENV['DB_USERNAME'],
                'password'        => $_ENV['DB_PASSWORD'],
            ],
        ],
    ]);
};