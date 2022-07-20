<?php

namespace Database\Interfaces;

use Database\Entities\UserEntity;
use Infrastructure\Interfaces\RepositoryInterface;
use Ramsey\Uuid\UuidInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function findByID(int $id): UserEntity;
    public function findByUUID(UuidInterface $uuid): UserEntity;
    public function findByEmail(string $email): UserEntity;
}