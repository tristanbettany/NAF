<?php

namespace Presentation\ViewModels;

final class ExampleViewModel extends AbstractViewModel
{
    public function getId(): int
    {
        return $this->offsetGet('id');
    }

    public function getName(): string
    {
        return $this->offsetGet('name');
    }
}