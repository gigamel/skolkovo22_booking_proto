<?php

declare(strict_types=1);

namespace Booking\Routing;

use App\Common\Routing\RouteInterface;
use Skolkovo22\Http\Protocol\ClientMessageInterface;

class Route implements RouteInterface
{
    /** @var string[] */
    protected $methods;
    
    /**
     * @param string $rule
     * @param string[] $methods
     * @param string $action
     *
     * @throws InvalidHttpMethodException
     */
    public function __construct(
        protected string $rule,
        protected string $action,
        array $methods
    ) {
        $this->setMethods($methods);
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @return string
     */
    public function getRule(): string
    {
        return $this->rule;
    }

    /**
     * @return string[]
     */
    public function getMethods(): array
    {
        return $this->methods;
    }
    
    /**
     * @param array $methods
     *
     * @return void
     *
     * @throws InvalidHttpMethodException
     */
    protected function setMethods(array $methods): void
    {
        foreach ($methods as $method) {
            if (!is_string($method)) {
                throw new InvalidHttpMethodException('HTTP method for route should be type of string');
            }
            
            $method = strtoupper($method);
            if (!in_array($method, ClientMessageInterface::HTTP_METHODS, true)) {
                throw new InvalidHttpMethodException('Unknown HTTP method for route');
            }
            
            $this->methods[] = $method;
        }
    }
}
