<?php

namespace Application\Actions;

use Domain\Interfaces\ExampleServiceInterface;
use Presentation\Responses\TwigTemplateResponse;
use Presentation\ViewModels\ExampleViewModel;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class RootAction extends AbstractAction
{
    public function __construct(
        private ExampleServiceInterface $exampleService
    ){
    }

    public function get(ServerRequestInterface $request): ResponseInterface
    {
        $data = $this->exampleService->getExampleData();

        return new TwigTemplateResponse(
            '@Base/root.html.twig',
            [
                'viewModel' => new ExampleViewModel($data),
            ]
        );
    }
}