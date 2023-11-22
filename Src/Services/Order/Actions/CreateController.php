<?php

declare(strict_types=1);

namespace App\Services\Order\Actions;

use App\Context\Restaurant\Order\Application\Create\OrderCreator;
use App\Context\Restaurant\Order\Application\Create\RequestOrderCreator;
use App\Context\Restaurant\Order\Infrastructure\Repository\OrderMongoRepository;
use App\Context\Restaurant\OrderItem\Infrastructure\Repository\OrderItemMongoRepository;
use App\Context\Restaurant\Product\Application\ReduceStockEventHandler;
use App\Context\Restaurant\Product\Infrastructure\Repository\ProductMongoRepository;
use App\Context\Shared\Infrastructure\EventBus;
use App\Context\Shared\Infrastructure\MongoDB\Restaurant\RestaurantMongoService;
use App\Services\Shared\Controller;
use App\Utilities\Constants\HttpStatusEnum;
use Psr\Http\Message\ServerRequestInterface as Request;

class CreateController extends Controller
{
    public function action(Request $request, $args)
    {

        $eventBus = new EventBus();
        $productMongoRepository = new ProductMongoRepository();
        $eventBus->subscribe(new ReduceStockEventHandler($productMongoRepository));

        $orderCreator = new OrderCreator(
            new OrderMongoRepository(),
            new OrderItemMongoRepository(),
            $productMongoRepository,
            $eventBus
        );

        $request = new RequestOrderCreator(
            $request->getParsedBody()['items']
        );

        $product = $orderCreator->create($request);

        return [
            'data' => $product,
            'status' => HttpStatusEnum::CREATED->value
        ];
    }
}
