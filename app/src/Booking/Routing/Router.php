<?php

declare(strict_types=1);

namespace Booking\Routing;

use App\Common\Routing\RouteInterface;
use App\Common\Routing\RouteNotFoundException;
use App\Common\Routing\RouterInterface;
use App\Common\Routing\RoutesCollectionInterface;
use Skolkovo22\Http\Protocol\ClientMessageInterface;

class Router implements RouterInterface
{
    /**
     * @param RoutesCollectionInterface $collection
     */
    public function __construct(protected RoutesCollectionInterface $collection)
    {
    }
    
    /**
     * @param ClientMessageInterface $request
     *
     * @return RouteInterface
     *
     * @throws RouteNotFoundException
     */
    public function handle(ClientMessageInterface $request): RouteInterface
    {
        foreach ($this->collection->getCollection() as $route) {
            if (!in_array($request->getMethod(), $route->getMethods(), true)) {
                continue;
            }
            
            if (preg_match(sprintf('#^%s$#', $route->getRule()), $request->getPath(), $attributes)) {
                foreach ($attributes as $attribute => $value) {
                    if (is_string($attribute)) {
                        $request->setAttribute($attribute, $value);
                    }
                }
                
                return $route;
            }
        }
        
        throw new RouteNotFoundException(sprintf('Unknown route id by path %s', $request->getPath()));
    }
}
