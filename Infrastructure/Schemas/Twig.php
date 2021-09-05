<?php

namespace Infrastructure\Schemas;

use Nette\Schema\Expect;
use Nette\Schema\Schema;

final class Twig
{
    public static function define(): Schema
    {
        return Expect::structure([
            'paths' => Expect::array()->required(),
            'options' => Expect::array()->required(),
            'extensions' => Expect::array(),
        ]);
    }

    public static function values(): array
    {
        return include_once __DIR__ . '/../../Application/Config/twig.php';
    }
}