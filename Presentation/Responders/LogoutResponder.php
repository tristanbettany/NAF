<?php

namespace Presentation\Responders;

use Laminas\Diactoros\Response\RedirectResponse;
use Presentation\Interfaces\LogoutResponderInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class LogoutResponder implements LogoutResponderInterface
{
    public function __invoke(
        ServerRequestInterface $request,
        mixed $data = null
    ): ResponseInterface {
        return new RedirectResponse('/login');
    }
}