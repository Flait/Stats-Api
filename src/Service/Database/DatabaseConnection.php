<?php
namespace App\Service\Database;

abstract class DatabaseConnection {
    protected mixed $connection;
    abstract public function query(string $query);
}