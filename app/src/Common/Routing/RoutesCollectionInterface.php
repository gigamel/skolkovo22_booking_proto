<?php

namespace App\Common\Routing;

interface RoutesCollectionInterface
{
    /**
     * @return RouteInterface[]
     */
    public function getCollection(): array;
}
