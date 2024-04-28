<?php

namespace App\Common\Routing;

use Skolkovo22\Http\ClientMessageInterface;

interface RouterInterface
{
    /**
     * @param ClientMessageInterface $request
     * 
     * @return string
     *
     * @throws RouteNotFoundException
     */
    public function handle(ClientMessageInterface $request): string;
}
