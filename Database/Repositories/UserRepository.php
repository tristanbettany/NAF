<?php

namespace Database\Repositories;

use Database\Interfaces\UserRepositoryInterface;
use Infrastructure\Abstractions\AbstractRepository;
use Ramsey\Uuid\UuidInterface;

final class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    private string $tableName = 'users';

    public function findByID(int $id): array
    {
        return $this->connection->createQueryBuilder()
            ->select('*')
            ->from($this->tableName)
            ->where('id = ?')
            ->setParameter(0, $id)
            ->fetchAssociative();
    }

    public function findByUUID(UuidInterface $uuid): array
    {
        return $this->connection->createQueryBuilder()
            ->select('*')
            ->from($this->tableName)
            ->where('uuid = ?')
            ->setParameter(0, $uuid->toString())
            ->fetchAssociative();
    }

    public function findByEmail(string $email): array
    {
        return $this->connection->createQueryBuilder()
            ->select('*')
            ->from($this->tableName)
            ->where('email = ?')
            ->setParameter(0, $email)
            ->fetchAssociative();
    }
}