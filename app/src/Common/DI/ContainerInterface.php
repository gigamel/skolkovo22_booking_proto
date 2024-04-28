<?php

namespace App\Common\DI;

interface ContainerInterface
{
    /**
     * @param string $id
     * @param mixed $dependency
     *
     * @return void
     */
    public function set(string $id, mixed $dependency): void;
    
    /**
     * @param string $id
     *
     * @return mixed
     *
     * @throws UnknownDependencyException
     */
    public function get(string $id): mixed;

    /**
     * @param string $id
     *
     * @return bool
     */
    public function has(string $id): bool;
}
