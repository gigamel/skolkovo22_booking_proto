<?php

declare(strict_types=1);

namespace Booking\Http;

use Skolkovo22\Http\Protocol\ClientMessageInterface;

final class Request implements ClientMessageInterface
{
    /** @var array */
    private $_attributes = [];

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

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->_attributes;
    }

    /**
     * @param string $name
     *
     * @return string|null
     */
    public function getAttribute(string $name): ?string
    {
        if ($this->hasAttribute($name)) {
            return $this->_attributes[$name];
        }

        return null;
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasAttribute(string $name): bool
    {
        return array_key_exists($name, $this->_attributes);
    }

    /**
     * @param string $name
     * @param string $value
     *
     * @return void
     */
    public function setAttribute(string $name, string $value): void
    {
        $this->_attributes[$name] = $value;
    }
}
