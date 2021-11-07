<?php

namespace Application\Actions;

use Application\Exceptions\MethodNotAllowedException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

abstract class AbstractAction
{
    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $method = strtolower($request->getMethod());

        if (method_exists($this, $method) === false) {
            throw new MethodNotAllowedException();
        }

        return $this->$method($request);
    }
}