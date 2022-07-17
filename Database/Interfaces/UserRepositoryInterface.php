<?php

namespace Database\Interfaces;

use Infrastructure\Interfaces\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function findByEmail(string $email): array;
}