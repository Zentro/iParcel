<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Services\TrackingService;

class TrackingController extends BaseController
{
    protected TrackingService $trackingService;
    /*  WHY THIS NO WORK
    public function __construct(ContainerInterface $container, TrackingService $trackingService)
    {
        parent::__construct($container);
        $this->trackingService= $trackingService;
    }
    */

    public function create(Request $request, Response $response): Response
    {
        $view = $this->view($request);
        return $view->render($response, 'tracking.html');
    }   

    public function trackingStatus(Request $request, Response $response): Response
    {
        $trackingnum = $request->getAttribute('trackingnum');

        $result = $this->trackingService->findParcelStatis($trackingnum); // call the method on $this
        // if the query returned a result, display the tracking information
        if ($result !== false) {
            echo '<table>';
            echo '<tr><th>Tracking Number</th><th>Status</th></tr>';
            echo '<tr><td>' . $result['parcel_id'] . '</td><td>' . $result['status'] . '</td></tr>';
            echo '</table>';
        } else {
            echo 'Invalid tracking number.';
        }
    }
}
?>