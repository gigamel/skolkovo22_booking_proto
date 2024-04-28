<?php

namespace App\Common\Routing;

use Skolkovo22\Http\ServerMessageInterface;

interface ModuleInterface
{
    /**
     * @return ServerMessageInterface
     */
    public function run(): ServerMessageInterface;
}
