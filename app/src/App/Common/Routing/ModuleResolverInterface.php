<?php

namespace App\Common\Routing;

use Skolkovo22\Http\Protocol\ClientMessageInterface;

interface ModuleResolverInterface
{
    /**
     * @param ClientMessageInterface $request
     *
     * @return string
     *
     * @throws ModuleNotFoundException
     */
    public function resolve(ClientMessageInterface $request): string;
}
