<?php

declare(strict_types=1);

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220716214153 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create Users Table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE IF NOT EXISTS `users` (
            `id` bigint unsigned NOT NULL AUTO_INCREMENT,
            `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
            `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
            `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
            `created_at` timestamp NULL DEFAULT NULL,
            `updated_at` timestamp NULL DEFAULT NULL,
            `sso_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
            PRIMARY KEY (`id`),
            UNIQUE KEY `users_email_unique` (`email`),
            UNIQUE KEY `users_sso_id_unique` (`sso_id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE IF EXISTS `users`;');
    }
}
