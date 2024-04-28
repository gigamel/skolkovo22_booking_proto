<?php

declare(strict_types=1);

namespace Booking\DI;

use App\Common\DI\ContainerInterface;
use App\Common\DI\UnknownDependencyException;

class Container implements ContainerInterface
{
    /** @var array */
    protected $_dependencies = [];
    
    /**
     * @param string $id
     * @param mixed $dependency
     *
     * @return void
     */
    public function set(string $id, mixed $dependency): void
    {
        $this->_dependencies[$id] = $dependency;
    }

    /**
     * @param string $id
     *
     * @return mixed
     *
     * @throws UnknownDependencyException
     */
    public function get(string $id): mixed
    {
        if ($this->has($id)) {
            return $this->_dependencies[$id];
        }
        
        throw new UnknownDependencyException(sprintf('Unknown %s service', $id));
    }

    /**
     * @param string $id
     *
     * @return bool
     */
    public function has(string $id): bool
    {
        return array_key_exists($id, $this->_dependencies);
    }
}
