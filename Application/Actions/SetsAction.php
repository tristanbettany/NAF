<?php

namespace Application\Actions;

use Domain\Interfaces\SetServiceInterface;
use Infrastructure\Core\AbstractAction;
use Infrastructure\Core\TwigTemplateResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class SetsAction extends AbstractAction
{
    public function __construct(
        private SetServiceInterface $setService
    ){
    }

    public function get(ServerRequestInterface $request): ResponseInterface
    {
        return new TwigTemplateResponse('@Base/sets.html.twig');
    }
}