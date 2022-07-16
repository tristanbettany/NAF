<?php

namespace Database\Interfaces;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function findByEmail(string $email): array;
}