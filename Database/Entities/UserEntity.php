<?php

namespace Database\Entities;

use DateTimeInterface;
use Infrastructure\Abstractions\AbstractEntity;

final class UserEntity extends AbstractEntity
{
    public const TABLE = 'users';
    public const ALIAS = 'user';

    public int $id;

    public string $uuid;

    public string $firstName;
    public string $lastName;
    public string $email;
    public string $passwordHash;

    public bool $isAdmin;
    public bool $isActive;

    public ?DateTimeInterface $createdAt = null;
    public ?DateTimeInterface $updatedAt = null;
}