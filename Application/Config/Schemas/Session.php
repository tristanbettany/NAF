<?php

namespace Application\Config\Schemas;

use Nette\Schema\Expect;
use Nette\Schema\Schema;

final class Session
{
    public static function define(): Schema
    {
        return Expect::structure([
            'validators' => Expect::array(),
        ]);
    }

    public static function values(): array
    {
        return include_once __DIR__ . '/../session.php';
    }
}