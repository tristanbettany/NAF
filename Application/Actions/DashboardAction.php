<?php

namespace Application\Actions;

use Domain\Interfaces\RootServiceInterface;
use Infrastructure\Abstractions\AbstractAction;
use Presentation\Interfaces\DashboardResponderInterface;
use Psr\Http\Message\ResponseInterface;

final class DashboardAction extends AbstractAction
{
    public function __construct(
        private RootServiceInterface $rootService,
        private DashboardResponderInterface $responder
    ) {
    }

    public function get(): ResponseInterface
    {
        return $this->respond($this->responder);
    }
}