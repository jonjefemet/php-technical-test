<?php

declare(strict_types=1);

namespace App\Services\Product\Actions;

use App\Services\Shared\Controller;
use Psr\Http\Message\ServerRequestInterface as Request;


class CreateController extends Controller
{
    public function action(Request $request, $args): array
    {
        return [
            'message' => 'Hello world!'
        ];
    }
}
