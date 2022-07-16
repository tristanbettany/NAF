<?php

namespace Application\Actions;

use Application\Exceptions\MethodNotAllowedException;
use Presentation\Interfaces\ResponderInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

abstract class AbstractAction
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