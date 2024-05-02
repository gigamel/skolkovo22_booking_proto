<?php

declare(strict_types=1);

namespace Modules\Skolkovo22\Estates\Service\Estate;

use App\Common\Storage\ConnectionInterface;

final class EstateRepository
{
    /** @var int */
    private $count;

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
        if (is_null($this->count)) {
            $this->count = $this->connection
                ->getConnection()
                ->query('SELECT COUNT(`id`) FROM `estate`;')
                ->fetchColumn();
        }

        return $this->count;
    }
}
