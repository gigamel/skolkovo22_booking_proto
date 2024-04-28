<?php

namespace App\Common\Http;

final class ForbiddenException extends HttpException
{
    /**
    * @param string $message
    * @param \Throwable|null $previous
    */
    public function __construct(
        string $message = 'Forbidden',
        ?\Throwable $previous = null
    ) {
        parent::__construct($message, 403, $previous);
    }
}
