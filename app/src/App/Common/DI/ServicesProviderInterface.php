<?php

namespace App\Common\DI;

interface ServicesProviderInterface
{
    /**
     * @param ContainerInterface $container
     *
     * @return void
     */
    public function provideServices(ContainerInterface $container): void;
}
