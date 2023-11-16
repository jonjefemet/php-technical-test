<?php

declare(strict_types=1);

namespace App\Services\Product\Actions;

use App\Context\Restaurant\Product\Application\SearchAll\ProductsFinder;
use App\Context\Restaurant\Product\Infrastructure\Repository\ProductMongoRepository;
use App\Services\Shared\Controller;
use Psr\Http\Message\ServerRequestInterface as Request;


class FindController extends Controller
{
    public function action(Request $request, $args)
    {
        $productFinder = new ProductsFinder(new ProductMongoRepository());

        $product = $productFinder->find();

        return $product;
    }
}
