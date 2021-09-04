<?php

namespace Domain\Services;

use Database\Interfaces\SetGatewayInterface;
use Domain\Interfaces\SetServiceInterface;

final class SetService implements SetServiceInterface
{
    public function __construct(
        private SetGatewayInterface $setGateway
    ){
    }

    public function getSets(): array
    {
        return $this->setGateway->getSets();
    }
}