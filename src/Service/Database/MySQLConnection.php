<?php

namespace App\Service\Database;

use Exception;
use mysqli;

class MySQLConnection extends DatabaseConnection {

    protected mixed $connection = null;

    public function __construct(
        private string $host,
        private string $username,
        private string $password,
        private string $dbname
    ) {
    }

    private function connect(): void {
        if ($this->connection === null) {
            $this->connection = new mysqli($this->host, $this->username, $this->password, $this->dbname);
            if ($this->connection->connect_error) {
                throw new Exception("Connection failed: " . $this->connection->connect_error);
            }
        }
    }

    public function query(string $query) {
        $this->connect();
        return $this->connection->query($query);
    }

    public function getConnection(): ?mysqli {
        $this->connect(); // Ensure the connection is established before returning it
        return $this->connection;
    }
}