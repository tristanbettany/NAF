<?php

namespace Infrastructure\Abstractions;

use Infrastructure\Interfaces\ViewModelInterface;
use Spatie\DataTransferObject\DataTransferObject;

abstract class AbstractViewModel extends DataTransferObject implements ViewModelInterface
{
}