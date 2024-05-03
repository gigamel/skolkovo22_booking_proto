<?php

declare(strict_types=1);

namespace Booking;

use App\Common\DI\ContainerInterface;
use App\Common\DI\ReflectorInterface;
use App\Common\Routing\ModuleInterface;
use App\Common\Routing\RouterInterface;
use App\Common\Routing\RoutesCollectionInterface;
use App\Common\Storage\ConnectionInterface;
use Booking\DI\Container;
use Booking\DI\Reflector;
use Booking\Http\Request;
use Booking\Http\ThrowableHandler;
use Booking\Routing\ModuleResolver;
use Booking\Routing\Router;
use Booking\Service\Currency\Converter;
use Booking\Service\Storage\Connection;
use Skolkovo22\Http\Protocol\ClientMessageInterface;

final class App
{
    /** @var bool */
    private $booted = false;
    
    /**
     * @param string $baseDirectory
     */
    public function __construct(protected string $baseDirectory)
    {
    }
    
    /**
     * @return void
     */
    public function run(): void
    {
        try {
            $this->processApplication();
        } catch (\Throwable $e) {
            $this->processThrowable($e);
        }
    }
    
    /**
     * @return void
     *
     * @throws \Throwable
     */
    private function processApplication(): void
    {
        if ($this->booted) {
            return;
        }

        $startMicroTime = microtime(true);

        $request = new Request();
        $container = new Container();
        $reflector = new Reflector($container);

        $this->loadDIContainer($container, $reflector);

        $module = $this->createInstanceModule($request, $container, $reflector);
        $httpResponse = $module->run($request);

        $httpResponse->putHeader('Skolkovo-Profiler-Time', (string)(microtime(true) - $startMicroTime));
        $httpResponse->send();

        echo $httpResponse->getBody();
        $this->booted = true;
    }
    
    /**
     * @param \Throwable $e
     */
    private function processThrowable(\Throwable $e): void
    {
        (new ThrowableHandler($e, $this->baseDirectory, true))->processThrowable();
    }
    
    /**
     * @param ContainerInterface $container
     * @param ReflectorInterface $reflector
     *
     * @return void
     */
    private function loadDIContainer(ContainerInterface $container, ReflectorInterface $reflector): void
    {
        $reflector->import($this->baseDirectory . '/config/services.php');

        $container->set(Converter::class, new Converter());
        $container->set(RoutesCollectionInterface::class, $this->getRoutesCollection());
        $container->set(RouterInterface::class, $reflector->autowire(Router::class));
        $container->set(ConnectionInterface::class, $reflector->autowire(Connection::class));
    }

    /**
     * @param ClientMessageInterface $request
     * @param ContainerInterface $container
     * @param ReflectorInterface $reflector
     *
     * @return ModuleInterface
     */
    private function createInstanceModule(ClientMessageInterface $request, ContainerInterface $container, ReflectorInterface $reflector): ModuleInterface
    {
        $resolver = (new ModuleResolver(
            $container->get(RouterInterface::class),
            $reflector,
            $container,
            $this->getBaseViewDirectory()
        ));

        $resolver->setDefaultModuleId('skolkovo22.base');

        return $resolver->resolve($request);
    }

    /**
     * @return RoutesCollectionInterface
     */
    private function getRoutesCollection(): RoutesCollectionInterface
    {
        return require_once($this->baseDirectory . '/config/routes.php');
    }

    /**
     * @return string
     */
    private function getBaseViewDirectory(): string
    {
        return $this->baseDirectory . '/view';
    }
}
