<?php

namespace Presentation\Responders;

use Laminas\Diactoros\Response\RedirectResponse;
use Presentation\Interfaces\LoginResponderInterface;
use Presentation\Responses\TwigTemplateResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class LoginResponder implements LoginResponderInterface
{
    public function __invoke(
        ServerRequestInterface $request,
        mixed $data = null
    ): ResponseInterface {
        if ($request->getMethod() === 'POST') {
            if ($data['isLoggedIn'] === true) {
                return new RedirectResponse('/dashboard');
            }
        }

        return new TwigTemplateResponse(
            '@Base/login.html.twig',
        );
    }
}