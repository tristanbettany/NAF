<?php

namespace Infrastructure\Interfaces;

use PDO;

interface ConnectionInterface
{
    public function get(): PDO;
}