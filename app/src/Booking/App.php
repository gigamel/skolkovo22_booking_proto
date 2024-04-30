<?php

declare(strict_types=1);

namespace Booking;

use App\Common\DI\ContainerInterface;
use App\Common\Routing\ModuleInterface;
use App\Common\Routing\RoutesCollectionInterface;
use App\Common\Storage\ConnectionInterface;
use Booking\DI\Container;
use Booking\Http\Request;
use Booking\Http\ThrowableHandler;
use Booking\Routing\ModuleResolver;
use Booking\Routing\Router;
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

        $request = new Request();
        $module = $this->createInstanceModule($request);
        $httpResponse = $module->run($request);
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
     * @return ContainerInterface
     */
    private function loadDIContainer(): ContainerInterface
    {
        $di = new Container();
        $services = require_once($this->baseDirectory . '/config/services.php');
        $di->set(ConnectionInterface::class, new Connection(...$services[Connection::class]));
        return $di;
    }

    /**
     * @param ClientMessageInterface $request
     *
     * @return ModuleInterface
     */
    private function createInstanceModule(ClientMessageInterface $request): ModuleInterface
    {
        return (new ModuleResolver(
            new Router($this->getRoutesCollection()),
            $this->loadDIContainer()
        ))->resolve($request);
    }

    /**
     * @return RoutesCollectionInterface
     */
    private function getRoutesCollection(): RoutesCollectionInterface
    {
        return require_once($this->baseDirectory . '/config/routes.php');
    }
}
