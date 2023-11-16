<?php

declare(strict_types=1);

namespace App\Services\Product\Actions;

use App\Context\Restaurant\Product\Application\Create\ProductCreator;
use App\Context\Restaurant\Product\Application\Create\RequestCreateProduct;
use App\Context\Restaurant\Product\Infrastructure\Repository\ProductMongoRepository;
use App\Services\Shared\Controller;
use App\Utilities\Constants\HttpStatusEnum;
use Psr\Http\Message\ServerRequestInterface as Request;


class CreateController extends Controller
{
    public function action(Request $request, $args)
    {
        $productCreator = new ProductCreator(new ProductMongoRepository());
        $request = new RequestCreateProduct(
            $request->getParsedBody()['name'],
            $request->getParsedBody()['price'],
            $request->getParsedBody()['stock'],
        );
        $product = $productCreator->create($request);

        return [
            'data' => $product,
            'status' => HttpStatusEnum::CREATED->value
        ];
    }
}
