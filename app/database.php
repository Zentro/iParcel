<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        PDO::class => function (ContainerInterface $c) {
            $config = $c->get('config');
            $host = $config['database']['host'];
            $database = $config['database']['database'];
            $username = $config['database']['username'];
            $password = $config['database']['password'];
            $dsn = "mysql:host=$host;dbname=$database";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ];

            return new PDO($dsn, $username, $password, $options);
        }
    ]);
};