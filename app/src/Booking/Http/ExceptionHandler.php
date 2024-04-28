<?php

declare(strict_types=1);

namespace Booking\Http;

use App\Common\Http\ExceptionHandlerInterface;
use App\Common\Http\HttpException;
use Skolkovo22\Http\Protocol\ServerMessageInterface;

class ExceptionHandler implements ExceptionHandlerInterface
{
    /**
     * @param \Exception $e
     *
     * @return ServerMessageInterface
     */
    public function handle(\Exception $e): ServerMessageInterface
    {
        if ($e instanceof HttpException) {
            return new Response($e->getMessage(), $e->getCode());
        }
        
        return new Response('Oops! Unknown error.', ServerMessageInterface::STATUS_INTERNAL_SERVER_ERROR);
    }
}
