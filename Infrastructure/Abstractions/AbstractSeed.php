<?php

namespace Infrastructure\Abstractions;

use Doctrine\DBAL\Connection as DoctrineConnection;
use Faker\Factory;
use Faker\Generator;

abstract class AbstractSeed
{
    protected Generator $faker;

    public function __construct(
        protected DoctrineConnection $connection
    ) {
        $this->faker = Factory::create();
    }
}