<?php

namespace Presentation\Responders;

use Laminas\Diactoros\Response\RedirectResponse;
use Presentation\Interfaces\RootResponderInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class RootResponder implements RootResponderInterface
{
    public function __invoke(
        ServerRequestInterface $request,
        mixed $data = null
    ): ResponseInterface {
        return new RedirectResponse('/login');
    }
}