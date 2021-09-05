<?php

namespace Infrastructure\Core;

use Infrastructure\Facades\Config;
use Laminas\Diactoros\Response\HtmlResponse;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

final class TemplateResponse extends HtmlResponse
{
    public function __construct(
        string $templateName,
        array $payload = [],
        int $status = 200,
        array $headers = []
    ) {
        parent::__construct(
            $this->renderTemplate($templateName, $payload),
            $status,
            $headers
        );
    }

    private function renderTemplate(
        string $templateName,
        array $payload = []
    ): string {
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
            $templateName,
            $payload
        );
    }
}