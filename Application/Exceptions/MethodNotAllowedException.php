<?php

namespace Application\Exceptions;

use RuntimeException;

final class MethodNotAllowedException extends RuntimeException
{
    public function __construct(
        $message = 'Method Not Allowed',
        $code = 405
    ) {
        parent::__construct(
            $message,
            $code
        );
    }
}