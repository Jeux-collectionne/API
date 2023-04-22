<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Business\PlayersBusiness;
use Symfony\Component\HttpFoundation\Response;

#[Route('/players', name:'players_controller')]
class PlayersController extends AbstractController
{
    public function __construct(private PlayersBusiness $playersBusiness){}


    #[Route('/', name: 'app_players', methods:'GET')]
    public function index(): JsonResponse
    {
        $players = $this->playersBusiness->getPlayers();
        return $this->json($players, 200, [], [
            'groups' => 'public'
        ]);
    }

    #[Route('/{id}', name: 'app_player', methods:'GET')]
    public function getPlayer(
        ?string $id,
    ): JsonResponse
    {
        $player = $this->playersBusiness->getPlayer($id);
        return $this->json($player, 200, [], [
            'groups' => 'public'
        ]);
    }
}
