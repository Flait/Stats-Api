<?php
namespace App\Entity\Attribute;

use App\Entity\User;

abstract class UserAttribute
{
        private readonly int $id;
        private DateTime $measuredAt;
        private \App\Entity\User $user;
}