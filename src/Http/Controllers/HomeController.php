<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class HomeController extends BaseController
{
    public function actionIndex(Request $request, Response $response): Response
    {
        $view = $this->view($request);
        return $view->render($response, 'home.html');
    }
}