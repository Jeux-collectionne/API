<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Business\PlayersBusiness;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\Players;
use App\RequestBody\PlayerBody;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


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
        Players $id,
    ): JsonResponse
    {
        return $this->json($id, 200, [], [
            'groups' => 'public'
        ]);
    }

    #[Route('/register', name:'register_player', methods:'POST')]
    #[ParamConverter]
    public function registerPlayer(Request $request)
    {
        $playerBody = new PlayerBody($request->getContent());
        dd($playerBody);
        return $this->json($playerBody, 200, [], [
            'groups' => 'private'
        ]);
    }
}
