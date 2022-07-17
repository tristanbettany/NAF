<?php

namespace Database\Repositories;

use Database\Interfaces\UserRepositoryInterface;
use Infrastructure\Abstractions\AbstractRepository;

final class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    private string $tableName = 'users';

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