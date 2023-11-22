<?php

declare(strict_types=1);

namespace App\Services\Order\Actions;

use App\Context\Restaurant\Order\Application\Create\OrderCreator;
use App\Context\Restaurant\Order\Application\Create\RequestOrderCreator;
use App\Context\Restaurant\Order\Application\Search\OrdersFinder;
use App\Context\Restaurant\Order\Infrastructure\Repository\OrderMongoRepository;
use App\Context\Restaurant\OrderItem\Infrastructure\Repository\OrderItemMongoRepository;
use App\Context\Restaurant\Product\Application\ReduceStockEventHandler;
use App\Context\Restaurant\Product\Infrastructure\Repository\ProductMongoRepository;
use App\Context\Shared\Infrastructure\EventBus;
use App\Context\Shared\Infrastructure\MongoDB\Restaurant\RestaurantMongoService;
use App\Services\Shared\Controller;
use App\Utilities\Constants\HttpStatusEnum;
use Psr\Http\Message\ServerRequestInterface as Request;

class FindController extends Controller
{
    public function action(Request $request, $args)
    {

        $finder = new OrdersFinder(
            new OrderMongoRepository(),
            new OrderItemMongoRepository()
        );


        return [
            'data' => $finder->find(),
            'status' => HttpStatusEnum::OK->value
        ];
    }
}
