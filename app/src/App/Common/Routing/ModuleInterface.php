<?php

namespace App\Common\Routing;

use Skolkovo22\Http\Protocol\ServerMessageInterface;

interface ModuleInterface
{
    /**
     * @return ServerMessageInterface
     */
    public function run(): ServerMessageInterface;
}
