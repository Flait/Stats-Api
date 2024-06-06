<?php
namespace App\Controller;

use App\Repository\MySQLUserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController {
    private MySQLUserRepository $userRepository;

    public function __construct(MySQLUserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    #[Route('/{id}', methods: ['GET'])]
    public function showUser(int $id): Response {
        $user = $this->userRepository->searchById($id);

        if (!$user) {
            throw $this->createNotFoundException('The user does not exist');
        }

        return $this->json($user);
    }
}