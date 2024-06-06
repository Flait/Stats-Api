<?php

namespace App\Entity;

class User
{
    public function __construct(
        readonly private int $id,
        private string $name,
        private string $password,
    )
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        // Hash the password before storing it
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        return $this;
    }
}