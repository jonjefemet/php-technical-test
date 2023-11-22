<?php

declare(strict_types=1);

namespace App;

use App\Services\Order\OrderRoutes;
use App\Services\Product\ProductRoutes;
use Slim\App;

class RouteProvider
{
    public function register(App $app)
    {
        ProductRoutes::register($app);
        OrderRoutes::register($app);
    }
}
