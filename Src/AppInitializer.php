<?php

declare(strict_types=1);

namespace App;

use Slim\Factory\AppFactory;

class AppInitializer
{
    public function run()
    {
        $app = AppFactory::create();

        $app->addRoutingMiddleware();
        $app->addBodyParsingMiddleware();

        $errorMiddleware = $app->addErrorMiddleware(true, true, true);

        $routeProvider = new RouteProvider();
        $routeProvider->register($app);

        $app->run();
    }
}
