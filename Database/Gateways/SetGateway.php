<?php

namespace Database\Gateways;

use Database\Interfaces\SetGatewayInterface;
use Infrastructure\Core\AbstractGateway;

final class SetGateway extends AbstractGateway implements SetGatewayInterface
{
    public function getSets(): array
    {
        return $this->fetchAll('SELECT * FROM sets');
    }
}