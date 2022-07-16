<?php

namespace Application\Actions;

use Domain\Interfaces\ExampleServiceInterface;
use Presentation\Interfaces\RootResponderInterface;
use Psr\Http\Message\ResponseInterface;

final class RootAction extends AbstractAction
{
    public function __construct(
        private ExampleServiceInterface $exampleService,
        private RootResponderInterface $responder
    ) {
    }

    public function get(): ResponseInterface
    {
        $data = $this->exampleService->getExampleData();

        return $this->respond($data, $this->responder);
    }
}