<?php

declare(strict_types=1);

namespace Booking\Service\Storage;

use App\Common\Storage\ConnectionInterface;

class Connection implements ConnectionInterface
{
    /** @var \PDO */
    protected $_connection;
    
    /**
     * @param string $dsn
     * @param string $username
     * @param string $password
     * @param array $options
     */
    public function __construct(
        protected string $dsn,
        protected string $username,
        protected string $password,
        protected array $options = []
    ) {
    }
    
    /**
     * @return \PDO
     *
     * @throws \PDOException
     */
    public function getConnection(): \PDO
    {
        if (is_null($this->_connection)) {
            $this->_connection = new \PDO(
                $this->dsn,
                $this->username,
                $this->password,
                $this->options
            );
        }
        
        return $this->_connection;
    }
}
