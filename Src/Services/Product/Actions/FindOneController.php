<?php

declare(strict_types=1);

namespace App\Services\Product\Actions;

use App\Context\Restaurant\Product\Application\Search\ProductFinder;
use App\Context\Restaurant\Product\Domain\ProductId;
use App\Context\Restaurant\Product\Infrastructure\Repository\ProductMongoRepository;
use App\Services\Shared\Controller;
use Psr\Http\Message\ServerRequestInterface as Request;


class FindOneController extends Controller
{
    public function action(Request $request, $args)
    {
        $id = new ProductId($args['id']);
        $productFinder = new ProductFinder(new ProductMongoRepository());

        $product = $productFinder->find($id);

        return $product;
    }
}
