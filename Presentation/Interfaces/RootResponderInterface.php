<?php

namespace Presentation\Interfaces;

use Infrastructure\Interfaces\ResponderInterface;
use Presentation\Responses\TwigTemplateResponse;
use Psr\Http\Message\ServerRequestInterface;

interface RootResponderInterface extends ResponderInterface
{
    public function __invoke(
        mixed $data,
        ServerRequestInterface $request
    ): TwigTemplateResponse;
}
