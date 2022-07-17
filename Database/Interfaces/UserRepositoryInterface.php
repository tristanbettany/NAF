<?php

namespace Database\Interfaces;

use Infrastructure\Interfaces\RepositoryInterface;
use Ramsey\Uuid\UuidInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function findByID(int $id): array;
    public function findByUUID(UuidInterface $uuid): array;
    public function findByEmail(string $email): array;
}