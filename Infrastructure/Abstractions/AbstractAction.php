<?php

namespace Infrastructure\Abstractions;

use Application\Exceptions\MethodNotAllowedException;
use Infrastructure\Interfaces\ActionInterface;
use Infrastructure\Interfaces\ResponderInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

abstract class AbstractAction implements ActionInterface
{
    protected ServerRequestInterface $request;

    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $this->request = $request;

        $method = strtolower($request->getMethod());

        if (method_exists($this, $method) === false) {
            throw new MethodNotAllowedException();
        }

        return $this->$method();
    }

    protected function respond(
        mixed $data,
        ResponderInterface $responder
    ): ResponseInterface {
        return $responder($data, $this->request);
    }
}