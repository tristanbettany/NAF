<?php

namespace Presentation\ViewModels;

use ArrayObject;

abstract class AbstractViewModel extends ArrayObject
{
    public function __construct(array $data)
    {
        parent::__construct(
            $data
        );
    }
}