<?php

namespace App\Common\Http;

final class NotFoundException extends HttpException
{
    /**
     * @param string $message
     * @param \Throwable|null $previous
     */
    public function __construct(
        string $message = 'Not Found',
        ?\Throwable $previous = null
    ) {
        parent::__construct($message, 404, $previous);
    }
}
