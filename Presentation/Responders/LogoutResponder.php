<?php

namespace Presentation\Responders;

use Infrastructure\Abstractions\AbstractResponder;
use Laminas\Diactoros\Response\RedirectResponse;
use Presentation\Interfaces\LogoutResponderInterface;
use Psr\Http\Message\ResponseInterface;

final class LogoutResponder extends AbstractResponder implements LogoutResponderInterface
{
    public function get(mixed $data = null): ResponseInterface
    {
        return new RedirectResponse('/login');
    }
}