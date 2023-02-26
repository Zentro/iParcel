<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Slim\Views\Twig;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;

class BaseController 
{
    public $container;

    public $router;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function view(Request $request)
    {
        return Twig::fromRequest($request);
    }
}
