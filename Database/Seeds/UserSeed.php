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
            ->setValue('first_name', '?')
            ->setValue('last_name', '?')
            ->setValue('email', '?')
            ->setValue('password_hash', '?')
            ->setValue('is_admin', '?')
            ->setParameter('0', Uuid::uuid4()->toString())
            ->setParameter('1', 'Test')
            ->setParameter('2', 'Admin')
            ->setParameter('3', 'test@test.com')
            ->setParameter('4', Auth::hashPassword('letmein'))
            ->setParameter('5', true)
            ->executeQuery();
    }
}
