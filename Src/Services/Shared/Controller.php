<?php

declare(strict_types=1);

namespace App\Services\Shared;

use App\Utilities\Constants\HttpStatusEnum;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

abstract class Controller
{

    public abstract function action(Request $request, $args);

    protected function jsonResponse(Response $response, $data, int $status): \Psr\Http\Message\ResponseInterface
    {
        $response->getBody()->write(json_encode($data));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($status);
    }

    public function handleRequest(Request $request, Response $response, $args)
    {
        $result = $this->action($request, $args);

        $isCustomResponse = is_array($result) && array_key_exists('data', $result) && array_key_exists('status', $result);

        $data = $isCustomResponse ? $result['data'] : $result;
        $status = $isCustomResponse ? $result['status'] : HttpStatusEnum::OK->value;

        return $this->jsonResponse($response, $data, $status);
    }
}
