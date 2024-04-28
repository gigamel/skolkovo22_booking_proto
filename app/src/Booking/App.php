<?php

declare(strict_types=1);

namespace Booking;

use App\Common\DI\ContainerInterface;
use App\Common\Http\NotFoundException;
use Booking\DI\Container;
use Booking\Http\ThrowableHandler;

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
        
        $di = $this->loadDIContainer();

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
        return $di;
    }
}
