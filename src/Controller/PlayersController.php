<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class PlayersController extends AbstractController
{
    #[Route('/players/{id}', name: 'app_players')]
    public function index(
        string $id
    ): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PlayersController.php',
            'id' => $id
        ]);
    }
}
