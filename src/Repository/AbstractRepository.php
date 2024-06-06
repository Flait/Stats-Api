<?php

namespace App\Repository;

abstract class AbstractRepository
{
    abstract public function searchById(int $id);
}