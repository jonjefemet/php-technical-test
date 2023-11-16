<?php

declare(strict_types=1);

namespace App\Services\Product;

use App\Services\Product\Actions\CreateController;
use App\Services\Product\Actions\FindController;
use App\Services\Product\Actions\FindOneController;
use App\Services\Product\Actions\UpdateController;
use Slim\App;

final class ProductRoutes
{
    public static function register(App $app)
    {
        $app->get('/api/product', FindController::class . ':handleRequest');
        $app->get('/api/product/{id}', FindOneController::class . ':handleRequest');
        $app->post('/api/product', CreateController::class . ':handleRequest');
        $app->put('/api/product/{id}', UpdateController::class . ':handleRequest');
    }
}
