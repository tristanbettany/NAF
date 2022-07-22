<?php

namespace Application\Exceptions;

use RuntimeException;

final class UnsetHydrationEntityException extends RuntimeException
{
    public function __construct(
        $message = 'Unset hydration entity',
        $code = 400
    ) {
        parent::__construct(
            $message,
            $code
        );
    }
}