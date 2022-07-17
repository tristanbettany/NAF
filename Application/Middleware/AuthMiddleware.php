<?php

namespace Application\Middleware;

use Infrastructure\Facades\Auth;
use Laminas\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class AuthMiddleware implements MiddlewareInterface
{
    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {

        $loginPath = '/login';
        $dashPath = '/dashboard';
        $uriPattern = $request->getUri()->getPath();

        $isLoggedIn = Auth::check();

        if (
            $isLoggedIn === false
            && $uriPattern !== $loginPath
        ) {
            //If your not logged in and not on the login page
            return new RedirectResponse($loginPath);
        }

        if (
            $isLoggedIn === true
            && $uriPattern === $loginPath
        ) {
            //If you are logged in and on the login page
            return new RedirectResponse($dashPath);
        }

        return $handler->handle($request);
    }
}