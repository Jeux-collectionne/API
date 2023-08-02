<?php

namespace App\Controller;

use App\Business\UsersBusiness;
use App\Entity\Users;
use App\RequestBody\PlayerBody;
use Exception;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ApiLoginController extends AbstractFOSRestController
{
    public function __construct(private UsersBusiness $usersBusiness){}
    
    #[Route(path: '/register', methods: 'POST')]
    #[ParamConverter('playerBody', converter:"fos_rest.request_body")]
    public function registerPlayer(PlayerBody $playerBody, ValidatorInterface $validator, JWTTokenManagerInterface $jwtManager)
    {
        $errors = $validator->validate($playerBody);
        if (!empty($errors[0])) {
            throw new Exception(sprintf("%s : %s", $errors[0]->getMessage(), $errors[0]->getPropertyPath()), 1);
        }
        $user = $this->usersBusiness->addPlayer($playerBody);
        $token = $jwtManager->create($user);

        $view = $this->view([
            "token" => $token
        ]);
        return $this->handleView($view);
        
    }

    #[Route('/login', name:'app_login', methods:'POST')]
    public function index(#[CurrentUser] ?Users $user)
    {
        return $this->json([
            "code" => 201,
            "token" => 'à faire'
        ]);
    }

}
