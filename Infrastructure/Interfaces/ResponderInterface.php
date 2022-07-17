<?php

namespace Infrastructure\Interfaces;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

interface ResponderInterface
{
    public function __invoke(
        ServerRequestInterface $request,
        mixed $data = null
    ): ResponseInterface;
}
