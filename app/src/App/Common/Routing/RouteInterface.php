<?php

namespace App\Common\Routing;

interface RouteInterface
{
    /**
     * @return string
     */
    public function getRule(): string;

    /**
     * @return string[]
     */
    public function getMethods(): array;

    /**
     * @return string
     */
    public function getAction(): string;
}
