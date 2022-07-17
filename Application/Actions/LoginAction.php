<?php

namespace Application\Actions;

use Domain\Interfaces\RootServiceInterface;
use Infrastructure\Abstractions\AbstractAction;
use Infrastructure\Facades\Auth;
use Presentation\Interfaces\LoginResponderInterface;
use Psr\Http\Message\ResponseInterface;

final class LoginAction extends AbstractAction
{
    public function __construct(
        private RootServiceInterface $rootService,
        private LoginResponderInterface $responder
    ) {
    }

    public function get(): ResponseInterface
    {
        return $this->respond($this->responder);
    }

    public function post(): ResponseInterface
    {
        $body = $this->request->getParsedBody();

        $isLoggedIn = Auth::login(
            $body['email'],
            $body['password']
        );

        return $this->respond($this->responder, [
            'isLoggedIn' => $isLoggedIn
        ]);
    }
}