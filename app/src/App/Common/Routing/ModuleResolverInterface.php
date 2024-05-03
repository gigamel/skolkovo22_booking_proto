<?php

namespace App\Common\Routing;

use Skolkovo22\Http\Protocol\ClientMessageInterface;

interface ModuleResolverInterface
{
    /**
     * @param string $id
     *
     * @return void
     */
    public function setDefaultModuleId(string $id): void;

    /**
     * @param ClientMessageInterface $request
     *
     * @return ModuleInterface
     *
     * @throws ModuleNotFoundException
     */
    public function resolve(ClientMessageInterface $request): ModuleInterface;
}
