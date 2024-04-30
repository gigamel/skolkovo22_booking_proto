<?php

namespace App\Common\Routing;

use Skolkovo22\Http\Protocol\ClientMessageInterface;

interface ModuleResolverInterface
{
    /**
     * @param ClientMessageInterface $request
     *
     * @return ModuleInterface
     *
     * @throws ModuleNotFoundException
     */
    public function resolve(ClientMessageInterface $request): ModuleInterface;
}
