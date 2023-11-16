<?php

declare(strict_types=1);

namespace App;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Slim\Factory\AppFactory;

class AppInitializer
{
    public function run()
    {
        $app = AppFactory::create();

        $app->addRoutingMiddleware();

        $errorMiddleware = $app->addErrorMiddleware(true, true, true);

        $routeProvider = new RouteProvider();
        $routeProvider->register($app);

        $app->run();
    }
}
