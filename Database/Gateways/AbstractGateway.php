<?php

namespace Database\Gateways;

use Doctrine\DBAL\Connection as DoctrineConnection;

abstract class AbstractGateway
{
    public function __construct(
        protected DoctrineConnection $connection
    ) {
    }
}