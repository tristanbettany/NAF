<?php

declare(strict_types=1);

namespace Database\Migrations;

use Database\Entities\UserEntity;
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
        $this->addSql("
            CREATE TABLE IF NOT EXISTS `". UserEntity::TABLE ."` (
                `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                `password_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                `is_admin` tinyint(1) NOT NULL DEFAULT '0',
                `is_active` tinyint(1) NOT NULL DEFAULT '1',
                `created_at` timestamp NULL DEFAULT NULL,
                `updated_at` timestamp NULL DEFAULT NULL,
                PRIMARY KEY (`id`),
                UNIQUE KEY `users_email_unique` (`email`),
                UNIQUE KEY `users_uuid_unique` (`uuid`)
            ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
        ");
    }

    public function down(Schema $schema): void
    {
        $this->addSql("DROP TABLE IF EXISTS `". UserEntity::TABLE ."`;");
    }
}
