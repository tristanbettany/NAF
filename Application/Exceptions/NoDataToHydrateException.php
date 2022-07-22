<?php

namespace Application\Exceptions;

use RuntimeException;

final class NoDataToHydrateException extends RuntimeException
{
    public function __construct(
        $message = 'No data to hydrate',
        $code = 400
    ) {
        parent::__construct(
            $message,
            $code
        );
    }
}