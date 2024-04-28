<?php

declare(strict_types=1);

namespace Booking\Http;

use App\Common\Http\HttpException;
use Skolkovo22\Http\Protocol\ServerMessageInterface;

class Response implements ServerMessageInterface
{
    /** @var string */
    protected $body;
    
    /** @var int */
    protected $statusCode;
    
    /** @var array */
    protected $headers = [];
    
    /**
     * @param string $body
     * @param int $statusCode
     * @param array $headers
     */
    public function __construct(string $body = '', int $statusCode = self::STATUS_OK, array $headers = [])
    {
        $this->body = $body;
        $this->statusCode = $statusCode;
        $this->putHeaders($headers);
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }
    
    /**
     * @return string
     */
    public function getProtocolVersion(): string
    {
        return $_SERVER['SERVER_PROTOCOL'] ?? 'HTTP/1.1';
    }
    
    /**
     * @param array $headers
     *
     * @return void
     */
    public function putHeaders(array $headers): void
    {
        foreach ($headers as $header => $value) {
            $this->putHeader($header, $value);
        }
    }
    
    /**
     * @param string $header
     * @param string $value
     *
     * @return void
     */
    public function putHeader(string $header, string $value): void
    {
        $this->headers[\ucwords(\strtolower($header), '-')] = $value;
    }
    
    /**
     * @return void
     *
     * @throws HttpException
     */
    public function send(): void
    {
        if (\headers_sent()) {
            return;
        }
        
        $statusMessage = self::MESSAGES[$this->getStatusCode()] ?? null;
        if (\is_null($statusMessage)) {
            throw new HttpException();
        }
        
        foreach ($this->getHeaders() as $header => $value) {
            \header(\sprintf('%s: %s', $header, $value));
        }
        
        \header(\sprintf('%s %s %s', $this->getProtocolVersion(), $this->getStatusCode(), $statusMessage));
    }
}
