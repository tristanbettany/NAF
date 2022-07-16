<?php

namespace Presentation\Responses;

use Infrastructure\Facades\Config;
use Laminas\Diactoros\Response\HtmlResponse;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

final class TwigTemplateResponse extends HtmlResponse
{
    public function __construct(
        private string $templateName = '@Base/root.html.twig',
        private array $payload = [],
        private int $httpStatusCode = 200,
        private array $httpHeaders = []
    ) {
        parent::__construct(
            $this->renderTemplate(),
            $this->httpStatusCode,
            $this->httpHeaders
        );
    }

    private function renderTemplate(): string
    {
        $twigConfig = Config::get('twig');
        $twigLoader = new FilesystemLoader();

        foreach ($twigConfig['paths'] as $namespace => $path) {
            $twigLoader->addPath($path, $namespace);
        }

        $twigEnv = new Environment(
            $twigLoader,
            $twigConfig['options']
        );

        foreach ($twigConfig['extensions'] as $extension) {
            $twigEnv->addExtension(new $extension());
        }

        return $twigEnv->render(
            $this->templateName,
            $this->payload
        );
    }
}