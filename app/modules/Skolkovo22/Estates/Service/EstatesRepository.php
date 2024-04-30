<?php

declare(strict_types=1);

namespace Modules\Skolkovo22\Estates\Service;

use App\Common\Storage\ConnectionInterface;

final class EstatesRepository
{
    /**
     * @param ConnectionInterface $connection
     */
    public function __construct(private ConnectionInterface $connection)
    {
    }
    
    /**
     * @return array
     */
    public function getList(): array
    {
        return ['1', '2'];
    }
}
