<?php

namespace Application\Actions;

use Domain\Interfaces\RootServiceInterface;
use Infrastructure\Abstractions\AbstractAction;
use Presentation\Interfaces\RootResponderInterface;
use Psr\Http\Message\ResponseInterface;

final class RootAction extends AbstractAction
{
    public function __construct(
        private RootServiceInterface $rootService,
        private RootResponderInterface $responder
    ) {
    }

    public function get(): ResponseInterface
    {
        return $this->respond([], $this->responder);
    }
}