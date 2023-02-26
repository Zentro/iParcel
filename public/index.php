<?php
/**
 * A PHP web application
 */

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Version Check
|--------------------------------------------------------------------------
|
| We need to check to make sure that the PHP version we're using will be
| compatible with our app. Otherwise abort the boot process here and inform
| the client's browser of the incompatibility.
|
*/
$phpVersion = phpversion();
if (version_compare($phpVersion, '7.0.0', '<'))
{
	die("PHP 7.0.0 or newer is required. $phpVersion does not meet this requirement.");
}

use Slim\Views\Twig;
use DI\ContainerBuilder;
use Slim\Views\TwigMiddleware;
use DI\Bridge\Slim\Bridge as AppFactory;

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to utilize it! We'll simply require it
| into the script here so that we don't have to worry about manual
| loading any of our classes later on. It feels nice to relax.
|
*/
require __DIR__ . '/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Build The Container
|--------------------------------------------------------------------------
|
| We want to use the optional container to prepare, manage, and inject
| application dependencies.
|
*/
$containerBuilder = new ContainerBuilder();

$config = require __DIR__ .'/../app/config.php';
$config($containerBuilder);

//$dependencies = require __DIR__ . '/../app/dependencies.php';
//$dependencies($containerBuilder);

//$database = require __DIR__ . '/../app/database.php';
//$database($containerBuilder);

$container = $containerBuilder->build();

/*
|--------------------------------------------------------------------------
| Initialize The Application
|--------------------------------------------------------------------------
|
| The application is now ready to boot, we just need to assemble the last
| few remaining pieces to serve a request to the client's browser such as
| the middleware, routes, and error handlers.
|
*/
$app = AppFactory::create($container);
$callableResolver = $app->getCallableResolver();

$twig = Twig::create(__DIR__ . '/../resources/views', ['cache' => false]);

$app->add(TwigMiddleware::create($app, $twig));

$routes = require __DIR__ . '/../app/routes.php';
$routes($app);

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| We have assembled everything and we're now ready to serve our application
| which will execute the request and send the respnse back to the client's
| browser.
|
*/
$app->run();