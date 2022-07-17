<?php

namespace Presentation\Responders;

use Presentation\Interfaces\DashboardResponderInterface;
use Presentation\Responses\TwigTemplateResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class DashboardResponder implements DashboardResponderInterface
{
    public function __invoke(
        ServerRequestInterface $request,
        mixed $data = null
    ): ResponseInterface {
        return new TwigTemplateResponse(
            '@Base/dashboard.html.twig',
        );
    }
}