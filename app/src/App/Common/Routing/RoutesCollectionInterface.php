<?php

namespace App\Common\Routing;

interface RoutesCollectionInterface
{
    /**
     * @param string $name
     *
     * @return RouteInterface
     *
     * @throws RouteNotFoundException
     */
    public function getRoute(string $name): RouteInterface;

    /**
     * @return RouteInterface[]
     */
    public function getCollection(): array;
}
