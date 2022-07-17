<?php

namespace Presentation\Responders;

use Infrastructure\Abstractions\AbstractResponder;
use Presentation\Interfaces\DashboardResponderInterface;
use Presentation\Responses\TwigTemplateResponse;
use Psr\Http\Message\ResponseInterface;

final class DashboardResponder extends AbstractResponder implements DashboardResponderInterface
{
    public function get(mixed $data = null): ResponseInterface
    {
        return new TwigTemplateResponse(
            '@Base/dashboard.html.twig',
        );
    }
}