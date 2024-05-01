<?php

declare(strict_types=1);

namespace Booking\Routing;

use App\Common\Routing\RouteInterface;
use App\Common\Routing\RouteNotFoundException;
use App\Common\Routing\RoutesCollectionInterface;
use Skolkovo22\Http\Protocol\ClientMessageInterface;

class RoutesCollection implements RoutesCollectionInterface
{
    /** @var array */
    protected $_collection = [];
    
    /**
     * @param string $id
     * @param string $rule
     * @param string $action
     * @param string[] $methods
     *
     * @return void
     *
     * @throws InvalidHttpMethodException
     * @throws RouteAlreadyExistsException
     */
    public function route(string $name, string $rule, string $action, array $methods = ClientMessageInterface::HTTP_METHODS): void
    {
        if (array_key_exists($name, $this->_collection)) {
            throw new RouteAlreadyExistsException(sprintf('Route %s already exists', $name));
        }

        $this->_collection[$name] = new Route($rule, $action, $methods);
    }

    /**
     * @param string $name
     *
     * @return RouteInterface
     *
     * @throws RouteNotFoundException
     */
    public function getRoute(string $name): RouteInterface
    {
        if (!array_key_exists($name, $this->_collection)) {
            throw new RouteNotFoundException(sprintf('Route name %s not found', $name));
        }

        return $this->_collection[$name];
    }

    /**
     * @return RouteInterface[]
     */
    public function getCollection(): array
    {
        return $this->_collection;
    }
}
