<?php

namespace App\Controller;

use App\Business\UsersBusiness;
use App\Entity\Users;
use App\Helper\CustomHelper;
use App\RequestBody\PlayerBody;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\AbstractFOSRestController;

#[Route('/players', name:'players_controller')]
class UsersController extends AbstractFOSRestController
{
    public function __construct(private UsersBusiness $usersBusiness, private CustomHelper $helper){}


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
    #[ParamConverter('playerBody', converter:"fos_rest.request_body")]
    public function registerPlayer(PlayerBody $playerBody)
    {

        if ($errors = $this->helper->validate($playerBody)) {
            return $this->json($errors);
        }

        $this->usersBusiness->addPlayer($playerBody);
        
        $view = [
            "code" => 201,
            "token" => "à faire"
        ];
        return $this->json($view);
        
    }
}
