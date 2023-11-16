<?php

declare(strict_types=1);

namespace App\Services\Product;

use App\Services\Product\Actions\CreateController;
use Slim\App;

final class ProductRoutes
{
    public static function register(App $app)
    {
        $app->get('/api/product', CreateController::class . ':handleRequest');
    }
}
