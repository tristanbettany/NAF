<?php

namespace Database\Repositories;

use Database\Interfaces\RepositoryInterface;
use Doctrine\DBAL\Connection as DoctrineConnection;

abstract class AbstractRepository implements RepositoryInterface
{
    public function __construct(
        protected DoctrineConnection $connection
    ) {
    }
}