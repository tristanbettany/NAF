<?php

namespace Database\Repositories;

use Database\Entities\UserEntity;
use Database\Interfaces\UserRepositoryInterface;
use Infrastructure\Abstractions\AbstractRepository;
use Ramsey\Uuid\UuidInterface;

final class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    protected string $entity = UserEntity::class;

    public function findByID(int $id): UserEntity
    {
        $data = $this->connection->createQueryBuilder()
            ->select('*')
            ->from(UserEntity::TABLE)
            ->where('id = ?')
            ->andWhere('is_active = ?')
            ->setParameter(0, $id)
            ->setParameter(1, 1)
            ->fetchAssociative();

        return $this->hydrate($data);
    }

    public function findByUUID(UuidInterface $uuid): UserEntity
    {
        $data = $this->connection->createQueryBuilder()
            ->select('*')
            ->from(UserEntity::TABLE)
            ->where('uuid = ?')
            ->andWhere('is_active = ?')
            ->setParameter(0, $uuid->toString())
            ->setParameter(1, 1)
            ->fetchAssociative();

        return $this->hydrate($data);
    }

    public function findByEmail(string $email): UserEntity
    {
        $data = $this->connection->createQueryBuilder()
            ->select('*')
            ->from(UserEntity::TABLE)
            ->where('email = ?')
            ->andWhere('is_active = ?')
            ->setParameter(0, $email)
            ->setParameter(1, 1)
            ->fetchAssociative();

        return $this->hydrate($data);
    }
}