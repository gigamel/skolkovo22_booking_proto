<?php

namespace App\Common\Storage;

interface ConnectionInterface
{
    /**
     * @return \PDO
     *
     * @throws \PDOException
     */
    public function getConnection(): \PDO;
}
