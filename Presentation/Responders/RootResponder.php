<?php

namespace Presentation\Responders;

use Infrastructure\Abstractions\AbstractResponder;
use Laminas\Diactoros\Response\RedirectResponse;
use Presentation\Interfaces\RootResponderInterface;
use Psr\Http\Message\ResponseInterface;

final class RootResponder extends AbstractResponder implements RootResponderInterface
{
    public function get(mixed $data = null): ResponseInterface
    {
        return new RedirectResponse('/login');
    }
}