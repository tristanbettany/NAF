<?php

namespace Database\Seeds;

use Database\Interfaces\SeedInterface;

final class UserSeed extends AbstractSeed implements SeedInterface
{
    public function seed(): void
    {
        $this->connection->createQueryBuilder()
            ->insert('users')
            ->setValue('name', '?')
            ->setValue('email', '?')
            ->setValue('password', '?')
            ->setValue('sso_id', '?')
            ->setParameter('0', 'Test User')
            ->setParameter('1', 'test@test.com')
            ->setParameter('2', 'test')
            ->setParameter('3', '12345')
            ->executeQuery();
    }
}