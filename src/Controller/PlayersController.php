<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PlayersRepository;
use App\Business\PlayersBusiness;

class PlayersController extends AbstractController
{

    public function __construct(private PlayersBusiness $playersBusiness)
    {
        // $this->playersService = new PlayersService();
    }


    // #[Route('/players/{id}', name: 'app_players')]
    // public function index(
    //     string $id
    // ): JsonResponse
    // {
    //     return $this->json([
    //         'message' => 'Welcome to your new controller!',
    //         'path' => 'src/Controller/PlayersController.php',
    //         'id' => $id
    //     ]);
    // }

    #[Route('/players/{id}', name: 'app_players')]
    public function index(
        ?string $id,
    )
    {
        $player = $this->playersBusiness->getPlayer($id);
        // $player = $playersService->getPlayer($id);
        return $this->json($player);
    }
}
