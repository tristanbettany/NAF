<?php

namespace Infrastructure\Abstractions;

use Doctrine\DBAL\Connection as DoctrineConnection;
use Infrastructure\Interfaces\RepositoryInterface;

abstract class AbstractRepository implements RepositoryInterface
{
    public function __construct(
        protected DoctrineConnection $connection
    ) {
    }
}