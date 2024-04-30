<?php

declare(strict_types=1);

namespace Booking\Routing;

use App\Common\Routing\RouteInterface;
use App\Common\Routing\RoutesCollectionInterface;
use Skolkovo22\Http\Protocol\ClientMessageInterface;

class RoutesCollection implements RoutesCollectionInterface
{
    /** @var array */
    protected $_collection = [];
    
    /** @var array */
    protected $_segments;
    
    /**
     * @param array $segments
     */
    public function __construct(array $segments = [])
    {
        $this->setSegments($segments);
    }
    
    /**
     * @param string $id
     * @param string $rule
     * @param string[] $methods
     *
     * @return void
     *
     * @throws InvalidHttpMethodException
     */
    public function route(string $id, string $rule, array $methods = ClientMessageInterface::HTTP_METHODS): void
    {
        $this->_collection[] = new Route($id, $this->resolveRule($rule), $methods);
    }
    
    /**
     * @return RouteInterface[]
     */
    public function getCollection(): array
    {
        return $this->_collection;
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
