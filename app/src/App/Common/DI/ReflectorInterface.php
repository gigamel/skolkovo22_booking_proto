<?php

namespace App\Common\DI;

interface ReflectorInterface
{
    /**
     * @param string $file
     *
     * @return void
     *
     * @throws UndefinedConfigFileException
     */
    public function import(string $file): void;
    
    /**
     * @param string $className
     *
     * @return object
     *
     * @throws UnknownClassException
     */
    public function autowire(string $className): object;
}
