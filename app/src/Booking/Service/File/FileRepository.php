<?php

declare(strict_types=1);

namespace Booking\Service\File;

use App\Common\Storage\ConnectionInterface;

final class FileRepository
{
    /**
     * @param ConnectionInterface $connection
     */
    public function __construct(private ConnectionInterface $connection)
    {
    }
    
    /**
     * @param string $entityType
     * @param int $entityId
     *
     * @return File[]
     */
    public function getByEntity(string $entityType, int $entityId): array
    {
        return $this->connection
            ->getConnection()
            ->query(
                sprintf(
                    'SELECT * FROM `file` WHERE entity_type = "%s" AND entity_id = %d;',
                    $entityType,
                    $entityId
                )
            )
            ->fetchAll(\PDO::FETCH_CLASS, File::class);
    }
    
    /**
     * @param string $entityType
     * @param int[] $entityIds
     *
     * @return File[]
     */
    public function getByEntityIds(string $entityType, array $entityIds): array
    {
        if (empty($entityIds)) {
            return [];
        }
        
        foreach ($entityIds as $entityId) {
            if (!is_int($entityId)) {
                return [];
            }
        }
        
        return $this->connection
            ->getConnection()
            ->query(
                sprintf(
                    'SELECT * FROM `file` WHERE entity_type = "%s" AND entity_id IN (%s);',
                    $entityType,
                    implode(',', $entityIds)
                )
            )
            ->fetchAll(\PDO::FETCH_CLASS, File::class);
    }
}
