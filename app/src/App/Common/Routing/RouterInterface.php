<?php

namespace App\Common\Routing;

use Skolkovo22\Http\Protocol\ClientMessageInterface;

interface RouterInterface
{
    /**
     * @param string $name
     * @param array $vars
     *
     * @return string
     */
    public function getRouteUrl(string $name, array $vars = []): string;

    /**
     * @param ClientMessageInterface $request
     * 
     * @return RouteInterface
     *
     * @throws RouteNotFoundException
     */
    public function handle(ClientMessageInterface $request): RouteInterface;
}
