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
    /** @var array */
    protected $_segments = [];

    /**
     * @param RoutesCollectionInterface $collection
     * @param array $segments
     */
    public function __construct(protected RoutesCollectionInterface $collection, array $segments = [])
    {
        $this->setSegments($segments);
    }

    /**
     * @inheritDoc
     */
    public function handle(ClientMessageInterface $request): RouteInterface
    {
        foreach ($this->collection->getCollection() as $route) {
            if (!in_array($request->getMethod(), $route->getMethods(), true)) {
                continue;
            }
            
            if (preg_match(sprintf('#^%s$#', $this->resolveRule($route->getRule())), $request->getPath(), $attributes)) {
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

    /**
     * @param string $name
     * @param array $vars
     *
     * @return string
     */
    public function getRouteUrl(string $name, array $vars = []): string
    {
        return $this->getRealRouteUrl($this->collection->getRoute($name)->getRule(), $vars);
    }

    /**
     * @param string $rule
     * @param array $vars
     *
     * @return string
     */
    protected function getRealRouteUrl(string $rule, array $vars): string
    {
        foreach ($vars as $var => $value) {
            $rule = $this->replaceVarUrl($rule, $var, $value);
        }

        return $rule;
    }

    /**
     * @param string $rule
     * @param string $var
     * @param string $value
     *
     * @return string
     */
    protected function replaceVarUrl(string $rule, string $var, string $value): string
    {
        return str_replace(sprintf('{%s}', $var), $value, $rule);
    }

    /**
     * @param array $segments
     *
     * @return void
     */
    protected function setSegments(array $segments): void
    {
        foreach ($segments as $segment => $regEx) {
            $this->setSegment($segment, $regEx);
        }
    }

    /**
     * @param string $segment
     * @param string $regEx
     *
     * @return void
     */
    protected function setSegment(string $segment, string $regEx): void
    {
        $this->_segments[$segment] = $regEx;
    }

    /**
     * @param string $rule
     *
     * @param string
     */
    protected function resolveRule(string $rule): string
    {
        foreach ($this->_segments as $segment => $regEx) {
            $rule = str_replace(
                sprintf('{%s}', $segment),
                sprintf('(?P<%s>%s)', $segment, $regEx),
                $rule
            );
        }

        return $rule;
    }
}
