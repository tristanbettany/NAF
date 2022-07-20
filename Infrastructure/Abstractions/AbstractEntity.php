<?php

namespace Infrastructure\Abstractions;

use Infrastructure\Interfaces\EntityInterface;
use Spatie\DataTransferObject\DataTransferObject;

abstract class AbstractEntity extends DataTransferObject implements EntityInterface
{
}