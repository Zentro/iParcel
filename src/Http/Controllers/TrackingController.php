<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class TrackingController extends BaseController
{
    public function create(Request $request, Response $response): Response
    {
        $view = $this->view($request);
        return $view->render($response, 'tracking.html');
    }
}