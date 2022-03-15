<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Infrastructure\Core\Kernel;

Kernel::boot();
Kernel::loadRouting();
Kernel::dispatchToAction();