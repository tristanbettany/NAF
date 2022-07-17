<?php

namespace Application\Actions;

use Domain\Interfaces\RootServiceInterface;
use Infrastructure\Abstractions\AbstractAction;
use Infrastructure\Facades\Auth;
use Presentation\Interfaces\LogoutResponderInterface;
use Psr\Http\Message\ResponseInterface;

final class LogoutAction extends AbstractAction
{
    public function __construct(
        private RootServiceInterface $rootService,
        private LogoutResponderInterface $responder
    ) {
    }

    public function get(): ResponseInterface
    {
        Auth::logout();

        return $this->respond($this->responder);
    }
}