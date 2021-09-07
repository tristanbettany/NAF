<?php

namespace Database\Seeds;

use Faker\Factory;

abstract class AbstractSeed
{
    protected $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }
}