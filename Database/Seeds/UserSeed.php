<?php

namespace Database\Seeds;

use Infrastructure\Abstractions\AbstractSeed;
use Infrastructure\Facades\Auth;
use Infrastructure\Interfaces\SeedInterface;
use Ramsey\Uuid\Uuid;

final class UserSeed extends AbstractSeed implements SeedInterface
{
    public function seed(): void
    {
        $this->connection->createQueryBuilder()
            ->insert('users')
            ->setValue('uuid', '?')
            ->setValue('name', '?')
            ->setValue('email', '?')
            ->setValue('password_hash', '?')
            ->setParameter('0', Uuid::uuid4()->toString())
            ->setParameter('1', 'Test User')
            ->setParameter('2', 'test@test.com')
            ->setParameter('3', Auth::hashPassword('letmein'))
            ->executeQuery();
    }
}