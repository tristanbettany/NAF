<?php

namespace Infrastructure\Core;

use Infrastructure\Interfaces\ConnectionInterface;
use PDOStatement;
use PDO;

abstract class AbstractGateway
{
    public function __construct(
        private ConnectionInterface $connection
    ){
    }

    public function fetch(
        string $query,
        array $bindings = []
    ): ?array {
        $preparedQuery = $this->prepareQuery(
            $query,
            $bindings
        );

        $result = $preparedQuery->fetch(PDO::FETCH_ASSOC);

        if ($result === false) {
            return null;
        }

        return $result;
    }

    public function fetchAll(
        string $query,
        array $bindings = []
    ): array {
        $preparedQuery = $this->prepareQuery(
            $query,
            $bindings
        );

        return $preparedQuery->fetchAll(PDO::FETCH_ASSOC);
    }

    public function execute(
        string $query,
        array $bindings = []
    ): void {
        $this->prepareQuery(
            $query,
            $bindings
        );
    }

    private function prepareQuery(
        string $query,
        array $bindings = []
    ): PDOStatement {
        $preparedQuery = $this->connection->get()->prepare($query);
        $preparedQuery->execute($bindings);

        return $preparedQuery;
    }
}