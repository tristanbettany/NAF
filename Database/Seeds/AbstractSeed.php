<?php

namespace Database\Seeds;

use Faker\Factory;
use Faker\Generator;
use Doctrine\DBAL\Connection as DoctrineConnection;

abstract class AbstractSeed
{
    protected Generator $faker;

    public function __construct(
        protected DoctrineConnection $connection
    ) {
        $this->faker = Factory::create();
    }
}