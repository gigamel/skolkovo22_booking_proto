<?php

declare(strict_types=1);

namespace Booking\Http;

use Skolkovo22\Http\Protocol\ClientMessageInterface;

final class Request implements ClientMessageInterface
{
    /**
     * @return string
     */
    public function getMethod(): string
    {
        return \strtoupper($_SERVER['REQUEST_METHOD']);
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return \parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: '/';
    }

    /**
     * @return string
     */
    public function getProtocolVersion(): string
    {
        return $_SERVER['SERVER_PROTOCOL'] ?? 'HTTP/1.1';
    }
}
