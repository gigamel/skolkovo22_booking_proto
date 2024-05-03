<?php

declare(strict_types=1);

namespace Booking\Routing;

use App\Common\DI\ContainerInterface;
use App\Common\DI\ReflectorInterface;
use App\Common\Routing\ModuleInterface;
use App\Common\Routing\ModuleNotFoundException;
use App\Common\Routing\ModuleResolverInterface;
use App\Common\Routing\RouteInterface;
use App\Common\Routing\RouteNotFoundException;
use App\Common\Routing\RouterInterface;
use Booking\Base\AbstractModule;
use Skolkovo22\Http\Protocol\ClientMessageInterface;

class ModuleResolver implements ModuleResolverInterface
{
    /** @var string|null */
    protected $defaultModuleId;

    /**
     * @param RouterInterface $router
     * @param ReflectorInterface $reflector
     * @param ContainerInterface $container
     * @param string $applicationBaseDirectory
     */
    public function __construct(
        protected RouterInterface $router,
        protected ReflectorInterface $reflector,
        protected ContainerInterface $container,
        protected string $baseViewDirectory
    ) {
    }
    
    /**
     * @inheritDoc
     */
    public function setDefaultModuleId(string $id): void
    {
        $this->defaultModuleId = $id;
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
        try {
            $route = $this->router->handle($request);
        } catch (RouteNotFoundException $e) {
            if (is_null($this->defaultModuleId)) {
                throw $e;
            }

            $route = new Route('/', $this->defaultModuleId, ClientMessageInterface::HTTP_METHODS);
        }
        
        $moduleClassName = sprintf('%s\\Module', $this->getModuleNamespace($route));
        if (!class_exists($moduleClassName)) {
            throw new ModuleNotFoundException(sprintf('Module class %s not found', $moduleClassName));
        }
        
        if (!is_a($moduleClassName, AbstractModule::class, true)) {
            throw new ModuleNotFoundException(sprintf('Module class %s must be instance of %s', $moduleClassName, AbstractModule::class));
        }

        $instanceModule = $this->reflector->autowire($moduleClassName);
        if ($instanceModule instanceof AbstractModule) {
            $instanceModule->setViewDir($this->getViewDir($route));
            $instanceModule->setRouter($this->router);
        }

        return $instanceModule;
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
            ucwords($route->getAction(), '.')
        );
    }

    /**
     * @param RouteInterface $route
     *
     * @return string
     */
    protected function getViewDir(RouteInterface $route): string
    {
        return $this->baseViewDirectory . '/' . str_replace('.', '/', strtolower($route->getAction()));
    }
}
