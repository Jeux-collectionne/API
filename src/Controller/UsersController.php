<?php

namespace App\Controller;

use App\Business\UsersBusiness;
use App\Entity\Users;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Security\Http\Attribute\CurrentUser;


#[Route('/players', name:'players_controller')]
class UsersController extends AbstractController
{
    public function __construct(private UsersBusiness $usersBusiness){}


    #[Route('/', name: 'app_players', methods:'GET')]
    public function index(): JsonResponse
    {
        $players = $this->usersBusiness->getUsers();
        return $this->json($players, 200, [], [
            'groups' => 'private'
        ]);
    }

    #[Route('/{id}', name: 'app_get_player', methods:'GET')]
    public function getPlayer(
        Users $id,
    ): JsonResponse
    {
        return $this->json($id, 200, [], [
            'groups' => 'private'
        ]);
    }

    #[Route('/register', name:'register_player', methods:'POST')]
    public function registerPlayer(Request $request): JsonResponse
    {
        $requestBody = json_decode($request->getContent(), true);

        if ($requestBody === null) {
            return $this->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'message' => 'missing credentials',
                ], Response::HTTP_BAD_REQUEST);
        }

        $this->usersBusiness->addPlayer($requestBody);

        return $this->json([
            "code" => 201,
            "token" => "à faire"
        ]);
    }
}
