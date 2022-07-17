<?php

namespace Domain\Interfaces;

interface SessionInterface
{
    public function set(
        string $key,
        mixed $value
    ): void;
    public function get(string $key): mixed;
    public function getFlash(string $key): mixed;
    public function delete(string $key): void;
}