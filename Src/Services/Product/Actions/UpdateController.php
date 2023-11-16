<?php

declare(strict_types=1);

namespace App\Services\Product\Actions;

use App\Context\Restaurant\Product\Application\Update\RequestUpdateProduct;
use App\Context\Restaurant\Product\Application\Update\ProductUpdater;
use App\Context\Restaurant\Product\Infrastructure\Repository\ProductMongoRepository;
use App\Services\Shared\Controller;
use Psr\Http\Message\ServerRequestInterface as Request;


class UpdateController extends Controller
{
    public function action(Request $request, $args)
    {
        $productUpdater = new ProductUpdater(new ProductMongoRepository());

        $requestUpdateProduct = new RequestUpdateProduct(
            $args['id'],
            $request->getParsedBody(),
        );
        $product = $productUpdater->update($requestUpdateProduct);

        return $product;
    }
}
