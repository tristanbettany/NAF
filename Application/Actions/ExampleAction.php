<?php

namespace Application\Actions;

use Domain\Interfaces\ExampleServiceInterface;
use Infrastructure\Core\AbstractAction;
use Presentation\Responses\TwigTemplateResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ExampleAction extends AbstractAction
{
    public function __construct(
        private ExampleServiceInterface $exampleService
    ){
    }

    public function get(ServerRequestInterface $request): ResponseInterface
    {
        return new TwigTemplateResponse('@Base/example-view.html.twig');
    }
}