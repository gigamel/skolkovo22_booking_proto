<?php

namespace App\Common\DI;

interface ServicesProviderInterface
{
    /**
     * @param ContainerInterface $container
     * @param ReflectorInterface $reflector
     *
     * @return void
     */
    public function provideServices(ContainerInterface $container, ReflectorInterface $reflector): void;
}
