<?php

namespace Application\Exceptions;

use RuntimeException;

final class ValidationException extends RuntimeException
{
    public function __construct(
        $message = 'Value Given is invalid',
        $code = 400
    ) {
        parent::__construct(
            $message,
            $code
        );
    }
}