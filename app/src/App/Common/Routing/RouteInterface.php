<?php

namespace App\Common\Routing;

interface RouteInterface
{
    /**
     * @return string
     */
    public function getId(): string;
    
    /**
     * @return string
     */
    public function getRule(): string;

    /**
     * @return string[]
     */
    public function getMethods(): array;
}
