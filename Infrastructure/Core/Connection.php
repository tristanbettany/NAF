<?php

namespace Infrastructure\Core;

use Infrastructure\Interfaces\ConnectionInterface;
use PDO;

final class Connection implements ConnectionInterface
{
    private PDO $pdo;

    public function __construct(
        string $host,
        int $port,
        string $dbName,
        string $username,
        ?string $password = null,
        string $charset = 'utf8'
    ){
        $this->pdo = new PDO(
            "mysql:host=$host;port=$port;dbname=$dbName;charset=$charset",
            $username,
            $password,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_PERSISTENT => false,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]
        );
    }

    public function get(): PDO
    {
        return $this->pdo;
    }
}