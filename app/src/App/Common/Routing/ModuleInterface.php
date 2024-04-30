<?php

namespace App\Common\Routing;

use Skolkovo22\Http\Protocol\ClientMessageInterface;
use Skolkovo22\Http\Protocol\ServerMessageInterface;

interface ModuleInterface
{
    /**
     * @param ClientMessageInterface $request
     *
     * @return ServerMessageInterface
     */
    public function run(ClientMessageInterface $request): ServerMessageInterface;
}
