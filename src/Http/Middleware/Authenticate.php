<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Authenticate extends BaseMiddleware
{
    /**
     * @param Request   $request  PSR7 request
     * @param Response  $response PSR7 response
     * @param callable  $next     Next middleware
     * 
     * @return Response
     */
    public function __invoke(Request $request, Response $response, $next): Response
    {
        $response = $next($request, $response);
        return $response;
    }
}