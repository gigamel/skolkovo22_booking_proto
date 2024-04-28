<?php

declare(strict_types=1);

namespace Booking\Http;

class JsonResponse extends Response
{
    /**
    * @param array $body
    * @param int $statusCode
    * @param array $headers
    */
    public function __construct(array $body = [], int $statusCode = self::STATUS_OK, array $headers = [])
    {
        parent::__construct(json_encode($body), $statusCode, $headers);
        $this->putHeader('Content-Type', 'application/json');
    }
}
