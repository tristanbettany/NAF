<?php

namespace Presentation\Responders;

use Infrastructure\Abstractions\AbstractResponder;
use Laminas\Diactoros\Response\RedirectResponse;
use Presentation\Interfaces\LoginResponderInterface;
use Presentation\Responses\TwigTemplateResponse;
use Psr\Http\Message\ResponseInterface;

final class LoginResponder extends AbstractResponder implements LoginResponderInterface
{
    public function get(mixed $data = null): ResponseInterface
    {
        return new TwigTemplateResponse(
            '@Base/login.html.twig',
        );
    }

    public function post(mixed $data = null): ResponseInterface
    {
        if ($data['isLoggedIn'] === true) {
            return new RedirectResponse('/dashboard');
        }

        return new TwigTemplateResponse(
            '@Base/login.html.twig',
        );
    }
}