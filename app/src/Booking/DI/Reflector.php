<?php

declare(strict_types=1);

namespace Booking\DI;

use App\Common\DI\ContainerInterface;
use App\Common\DI\ReflectorInterface;
use App\Common\DI\UndefinedConfigFileException;
use App\Common\DI\UnknownClassException;

class Reflector implements ReflectorInterface
{
    /** @var array */
    protected $_arguments = [];
    
    /**
     * @param ContainerInterface $container
     */
    public function __construct(protected ContainerInterface $container)
    {
    }
    
    /**
     * @param string $file
     *
     * @return void
     *
     * @throws UndefinedConfigFileException
     */
    public function import(string $file): void
    {
        if (!file_exists($file)) {
            throw new UndefinedConfigFileException(sprintf('Undefined config file %s', $file));
        }
        
        $config = require_once($file);
        if (!is_array($config)) {
            throw new UndefinedConfigFileException(sprintf('File config %s must contains array', $file));
        }
        
        $this->_arguments = array_merge($this->_arguments, $config);
    }

    /**
     * @param string $className
     *
     * @return object
     *
     * @throws UnknownClassException
     */
    public function autowire(string $className): object
    {
        if (!class_exists($className)) {
            throw new UnknownClassException(sprintf('Undefined class %s', $className));
        }
        
        $reflection = new \ReflectionClass($className);
        
        $constructor = $reflection->getConstructor();
        if (is_null($constructor)) {
            return $reflection->newInstance();
        }
        
        return $reflection->newInstanceArgs($this->getArguments($className, $constructor));
    }
    
    /**
     * @param string $className
     * @param \ReflectionMethod $method
     *
     * @return array
     */
    private function getArguments(string $className, \ReflectionMethod $method): array
    {
        $arguments = [];
        foreach ($method->getParameters() as $parameter) {
            $arguments[$parameter->getName()] = $this->getArgument($className, $parameter);
        }
        
        return $arguments;
    }
    
    /**
     * @param string $className
     * @param \ReflectionParameter $parameter
     *
     * @return mixed
     */
    private function getArgument(string $className, \ReflectionParameter $parameter): mixed
    {
        if ($parameter->hasType()) {
            $type = $parameter->getType()->getName();
            if (class_exists($type) || interface_exists($type)) {
                return $this->container->has($type) ? $this->container->get($type) : $this->autowire($type);
            }
        }
        
        $argument = $this->_arguments[$className][$parameter->getName()] ?? null;
        if (is_null($argument) && $parameter->isDefaultValueAvailable()) {
            return $parameter->getDefaultValue();
        }
        
        return $argument;
    }
}
