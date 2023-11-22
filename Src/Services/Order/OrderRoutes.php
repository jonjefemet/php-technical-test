<?php

declare(strict_types=1);

namespace App\Services\Order;

use App\Services\Order\Actions\CreateController;
use Slim\App;

final class OrderRoutes
{
    public static function register(App $app)
    {
        $app->post('/api/order', CreateController::class . ':handleRequest');
    }
}
