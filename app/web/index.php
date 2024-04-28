<?php

declare(strict_types=1);

use Booking\App;

require_once __DIR__ . '/../vendor/autoload.php';

(new App(dirname(__DIR__)))->run();
