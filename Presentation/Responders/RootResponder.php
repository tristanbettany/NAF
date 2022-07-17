<?php

namespace Presentation\Responders;

use Presentation\Interfaces\RootResponderInterface;
use Presentation\Responses\TwigTemplateResponse;
use Presentation\ViewModels\RootViewModel;
use Psr\Http\Message\ServerRequestInterface;

final class RootResponder implements RootResponderInterface
{
    public function __invoke(
        mixed $data,
        ServerRequestInterface $request
    ): TwigTemplateResponse {
        return new TwigTemplateResponse(
            '@Base/root.html.twig',
            [
                'viewModel' => new RootViewModel($data),
            ]
        );
    }
}