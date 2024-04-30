<?php

namespace App\Common\Routing;

use Skolkovo22\Http\Protocol\ClientMessageInterface;

interface RouterInterface
{
    /**
     * @param ClientMessageInterface $request
     * 
     * @return RouteInterface
     *
     * @throws RouteNotFoundException
     */
    public function handle(ClientMessageInterface $request): RouteInterface;
}
