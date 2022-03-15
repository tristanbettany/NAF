<?php

namespace Presentation\ViewModels;

final class ExampleViewModel extends AbstractViewModel
{
    public int $id;
    public string $name;

    public function getName(): string
    {
        return "Got $this->name via the getName() method";
    }
}