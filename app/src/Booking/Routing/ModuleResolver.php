<?php

declare(strict_types=1);

namespace Booking\Routing;

use App\Common\DI\ContainerInterface;
use App\Common\DI\ServicesProviderInterface;
use App\Common\Routing\ModuleInterface;
use App\Common\Routing\ModuleNotFoundException;
use App\Common\Routing\ModuleResolverInterface;
use App\Common\Routing\RouteInterface;
use App\Common\Routing\RouteNotFoundException;
use App\Common\Routing\RouterInterface;
use Skolkovo22\Http\Protocol\ClientMessageInterface;

class ModuleResolver implements ModuleResolverInterface
{
    /**
     * @param RouterInterface $router
     * @param ContainerInterface $container
     */
    public function __construct(
        protected RouterInterface $router,
        protected ContainerInterface $container
    ) {
    }
    
    /**
     * @param ClientMessageInterface $request
     *
     * @return ModuleInterface
     *
     * @throws ModuleNotFoundException
     */
    public function resolve(ClientMessageInterface $request): ModuleInterface
    {
        try {
            return $this->createModuleInstance($request);
        } catch (RouteNotFoundException $e) {
            throw new ModuleNotFoundException('Module not found');
        }
    }
    
    /**
     * @param ClientMessageInterface $request
     *
     * @return ModuleInterface
     *
     * @throws RouteNotFoundException
     */
    protected function createModuleInstance(ClientMessageInterface $request): ModuleInterface
    {
        $namespace = $this->getModuleNamespace($this->router->handle($request));
        
        $serviceProviderClassName = sprintf('%s\\ServicesProvider', $namespace);
        if (class_exists($serviceProviderClassName)) {
            if (!is_a($serviceProviderClassName, ServicesProviderInterface::class, true)) {
                throw new ModuleNotFoundException(
                    sprintf(
                        'Class %s must implements %s',
                        $serviceProviderClassName,
                        ServicesProviderInterface::class
                    )
                );
            }
            
            (new $serviceProviderClassName())->provideServices($this->container);
        }
        
        $moduleClassName = sprintf('%s\\Module', $namespace);
        if (!class_exists($moduleClassName)) {
            throw new ModuleNotFoundException(sprintf('Module class %s not found', $moduleClassName));
        }
        
        if (!is_a($moduleClassName, ModuleInterface::class, true)) {
            throw new ModuleNotFoundException(sprintf('Module class %s must implements %s', $moduleClassName, ModuleInterface::class));
        }
        
        return new $moduleClassName();
    }
    
    /**
     * @param RouteInterface $route
     *
     * @return string
     */
    protected function getModuleNamespace(RouteInterface $route): string
    {
        return 'Modules\\' . str_replace(
            '.',
            '\\',
            ucwords($route->getId(), '.')
        );
    }
}
