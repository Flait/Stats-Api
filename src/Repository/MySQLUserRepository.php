<?php
namespace App\Repository;

use App\Service\Database\MySQLConnection;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use Symfony\Component\Serializer\SerializerInterface;

class MySQLUserRepository extends AbstractRepository {

    public function __construct(
        private readonly MySQLConnection $connection,
        private readonly SerializerInterface $serializer
    ) {
    }

    public function searchById(int $id): ?User {
        $user = $this->connection->getConnection()->execute_query("SELECT * FROM users WHERE users.id=?", [$id])->fetch_assoc();

        return $this->serializer->deserialize(json_encode($user), User::class, 'json');
    }
}