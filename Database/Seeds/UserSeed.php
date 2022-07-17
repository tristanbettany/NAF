<?php

namespace Database\Seeds;

use Infrastructure\Abstractions\AbstractSeed;
use Infrastructure\Interfaces\SeedInterface;

final class UserSeed extends AbstractSeed implements SeedInterface
{
    public function seed(): void
    {
        $this->connection->createQueryBuilder()
            ->insert('users')
            ->setValue('name', '?')
            ->setValue('email', '?')
            ->setValue('password', '?')
            ->setParameter('0', 'Test User')
            ->setParameter('1', 'test@test.com')
            ->setParameter('2', 'test')
            ->executeQuery();
    }
}