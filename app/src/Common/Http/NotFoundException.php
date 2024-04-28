<?php

namespace App\Common\Http;

final class NotFoundException extends HttpException
{
    /**
     * @param string $message
     * @param \Throwable|null $previous
     */
    public function __construct(
        protected string $message = 'Not Found',
        protected ?\Throwable $previous = null
    ) {
        $this->code = 404;
    }
}
