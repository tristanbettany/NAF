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
        ResponderInterface $responder,
        mixed $data = null
    ): ResponseInterface {
        return $responder($this->request, $data);
    }

    protected function paginate(
        string $queryParam,
        int $itemsPerPage,
        int $totalItems,
        array $queryParams
    ): array {
        if ($totalItems !== 0) {
            $pageCount = ceil($totalItems / $itemsPerPage);
        } else {
            $pageCount = 0;
        }

        if (empty($queryParams[$queryParam]) === true) {
            $currentPage = 0; // First Page
        } else {
            $currentPage = $queryParams[$queryParam]; // Requested Page
        }

        if ($currentPage < 0) {
            $currentPage = 0; // Reset to first page if negative number
        }

        if ($currentPage > $pageCount) {
            $currentPage = $pageCount; // Reset to end of pages if higher than page count
        }

        if ($currentPage > 0) {
            $currentPage = $currentPage - 1; // Apparently take one off if we are greater than 0 (I cant remember why)
        }

        return [
            'currentPage' => $currentPage,
            'pageCount' => $pageCount,
        ];
    }
}
