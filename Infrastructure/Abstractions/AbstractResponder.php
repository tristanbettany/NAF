<?php

namespace Infrastructure\Abstractions;

use Application\Exceptions\MethodNotAllowedException;
use Infrastructure\Interfaces\ResponderInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

abstract class AbstractResponder implements ResponderInterface
{
    protected ServerRequestInterface $request;

    public function __invoke(
        ServerRequestInterface $request,
        mixed $data = null
    ): ResponseInterface {
        $this->request = $request;

        $method = strtolower($request->getMethod());

        if (method_exists($this, $method) === false) {
            throw new MethodNotAllowedException();
        }

        return $this->$method($data);
    }
}