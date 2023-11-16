<?php

declare(strict_types=1);

namespace App\Services\Product\Actions;

use App\Context\Restaurant\Product\Application\Delete\ProductDeletor;
use App\Context\Restaurant\Product\Domain\ProductId;
use App\Context\Restaurant\Product\Infrastructure\Repository\ProductMongoRepository;
use App\Services\Shared\Controller;
use App\Utilities\Constants\HttpStatusEnum;
use Psr\Http\Message\ServerRequestInterface as Request;


class DeleteController extends Controller
{
    public function action(Request $request, $args)
    {
        $productDeletor = new ProductDeletor(new ProductMongoRepository());
        $id = new ProductId($args['id']);
        $productDeletor->delete($id);

        return [
            'data' => null,
            'status' => HttpStatusEnum::NO_CONTENT->value
        ];
    }
}
