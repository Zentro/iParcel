<?php

declare(strict_types=1);

use App\Repositories\UserRepository;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        UserRepository::class => \DI\autowire(PDO::class),
    ]);
};