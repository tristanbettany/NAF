<?php

namespace Application\ExceptionHandlers;

use Whoops\Handler\Handler;

use function Sentry\captureException;

final class SentryExceptionHandler extends Handler
{
    public function handle()
    {
        captureException($this->getException());
    }
}
