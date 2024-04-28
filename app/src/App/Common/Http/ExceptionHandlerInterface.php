<?php

namespace App\Common\Http;

use Skolkovo22\Http\Protocol\ServerMessageInterface;

interface ExceptionHandlerInterface
{
    /**
     * @param \Exception $e
     *
     * @return ServerMessageInterface
     */
    public function handle(\Exception $e): ServerMessageInterface;
}
