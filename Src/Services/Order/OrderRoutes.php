<?php

declare(strict_types=1);

namespace App\Services\Order;

use App\Services\Order\Actions\CreateController;
use App\Services\Order\Actions\FindController;
use Slim\App;

final class OrderRoutes
{
    public static function register(App $app)
    {
        $app->get('/api/order', FindController::class . ':handleRequest');
        $app->post('/api/order', CreateController::class . ':handleRequest');
    }
}
