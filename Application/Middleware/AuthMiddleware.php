<?php

namespace Application\Middleware;

use Database\Interfaces\UserRepositoryInterface;
use Infrastructure\Facades\Container;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AuthMiddleware implements MiddlewareInterface
{
    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {

//        $repo = Container::get(UserRepositoryInterface::class);
//
//        $data = $repo->findByEmail('test@test.com');
//
//        dd($data);

        return $handler->handle($request);
    }
}