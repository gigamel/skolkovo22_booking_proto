<?php

namespace App\Common\Http;

use Skolkovo22\Http\Protocol\ServerMessageInterface;

interface ErrorHandlerInterface
{
    /**
     * @param \Error $e
     *
     * @return ServerMessageInterface
     */
    public function handle(\Error $e): ServerMessageInterface;
}
