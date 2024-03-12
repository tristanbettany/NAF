<?php

namespace Application\Middleware;

use Infrastructure\Facades\Auth;
use Infrastructure\Facades\Config;
use Infrastructure\Facades\Session;
use Laminas\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class FirewallMiddleware implements MiddlewareInterface
{
    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {

        $loginPath = Config::get('routes.login.uri');
        $dashPath = Config::get('routes.dashboard.uri');
        $uriPattern = $request->getUri()->getPath();

        $isLoggedIn = Auth::check();

        if (
            $isLoggedIn === false
            && $uriPattern !== $loginPath
        ) {
            // If your not logged in and not on the login page

            $path = $request->getUri()->getPath();
            if (empty($request->getUri()->getQuery()) === false) {
                $path .= '?' . $request->getUri()->getQuery();
            }

            // Lets store where you were trying to go
            Session::set('post-login-path', $path);

            return new RedirectResponse($loginPath);
        }

        if (
            $isLoggedIn === true
            && $uriPattern === $loginPath
        ) {
            // If you are logged in and on the login page
            return new RedirectResponse($dashPath);
        }

        return $handler->handle($request);
    }
}
