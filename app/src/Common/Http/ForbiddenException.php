<?php

namespace App\Common\Http;

final class ForbiddenException extends HttpException
{
    /**
    * @param string $message
    * @param \Throwable|null $previous
    */
    public function __construct(
        protected string $message = 'Forbidden',
        protected ?\Throwable $previous = null
    ) {
        $this->code = 403;
    }
}
