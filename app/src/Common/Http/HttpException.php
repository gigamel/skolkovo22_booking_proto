<?php

namespace App\Common\Http;

class HttpException extends \HttpException
{
    /**
     * @param string $message
     * @param int $code
     * @param \Throwable|null $previous
     */
    public function __construct(
        protected string $message = 'Server internal error',
        protected int $code = 500,
        protected ?\Throwable $previous = null
    ) {
    }
}
