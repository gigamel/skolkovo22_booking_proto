<?php

declare(strict_types=1);

namespace Modules\Skolkovo22\Estates\Service;

use App\Common\Storage\ConnectionInterface;
use Modules\Skolkovo22\Estates\Entity\Estate;

final class EstateRepository
{
    /**
     * @param ConnectionInterface $connection
     */
    public function __construct(private ConnectionInterface $connection)
    {
    }
    
    /**
     * @return Estate[]
     */
    public function getList(int $limit = 20, int $offset = 0): array
    {
        return $this->connection
            ->getConnection()
            ->query(sprintf('SELECT * FROM `estate` LIMIT %d OFFSET %d;', $limit, $offset))
            ->fetchAll(\PDO::FETCH_CLASS, Estate::class);
    }
    
    /**
     * @param int $id
     *
     * @return Estate|null
     */
    public function getById(int $id): ?Estate
    {
        return $this->connection
            ->getConnection()
            ->query(sprintf('SELECT * FROM `estate` WHERE `id`= %d;', $id))
            ->fetchObject(Estate::class) ?: null;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->connection
            ->getConnection()
            ->query('SELECT COUNT(`id`) FROM `estate`;')
            ->fetchColumn();
    }
}
