<?php

declare(strict_types=1);

namespace Booking\Http;

use App\Common\Http\ErrorHandlerInterface;
use Skolkovo22\Http\Protocol\ServerMessageInterface;

class ErrorHandler implements ErrorHandlerInterface
{
    /**
     * @param \Error $e
     *
     * @return ServerMessageInterface
     */
    public function handle(\Error $e): ServerMessageInterface
    {
        return new Response($e->getMessage(), ServerMessageInterface::STATUS_INTERNAL_SERVER_ERROR);
    }
}
