<?php

namespace Application\Exceptions;

use RuntimeException;

final class SelectBuildException extends RuntimeException
{
    public function __construct(
        $message = 'Cannot build select from entities',
        $code = 400
    ) {
        parent::__construct(
            $message,
            $code
        );
    }
}