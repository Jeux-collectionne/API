<?php

namespace App\Controller;

use App\Business\UsersBusiness;
use App\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Attribute\CurrentUser;


class ApiLoginController extends AbstractController
{
    public function __construct(private UsersBusiness $usersBusiness){}

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

    #[Route('/login', name:'app_login', methods:'POST')]
    public function index(#[CurrentUser] ?Users $user)
    {

        return $this->json([
            "code" => 201,
            "token" => "à faire"
        ]);
    }

}
