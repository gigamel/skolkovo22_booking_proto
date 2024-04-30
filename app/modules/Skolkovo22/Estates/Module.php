<?php

declare(strict_types=1);

namespace Modules\Skolkovo22\Estates;

use Booking\Http\Response;
use Skolkovo22\Http\Protocol\ClientMessageInterface;
use Skolkovo22\Http\Protocol\ServerMessageInterface;

final class Module extends AbstractEstatesModule
{
    /**
     * @param ClientMessageInterface $request
     *
     * @return ServerMessageInterface
     */
    public function run(ClientMessageInterface $request): ServerMessageInterface
    {
        return new Response('Estates 1 num');
    }
}
