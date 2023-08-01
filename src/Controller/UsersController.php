<?php

namespace App\Controller;

use App\Business\UsersBusiness;
use App\Entity\Users;
use App\Helper\CustomHelper;
use App\RequestBody\PlayerBody;
use Exception;
use FOS\RestBundle\Context\Context;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route(path: '/players')]
class UsersController extends AbstractFOSRestController
{
    public function __construct(private UsersBusiness $usersBusiness, private CustomHelper $helper){}

    #[Route(path: '', methods: 'GET')]
    public function getAllUsers()
    {
        $players = $this->usersBusiness->getUsers();
        $view = $this->view($players)->setContext((new Context())->setGroups(['public']));
        return $this->handleView($view);
    }

    #[Route(path: '/{user}', methods: 'GET')]
    public function getPlayer(Users $user)
    {
        $view = $this->view($user)->setContext((new Context())->setGroups(['public']));
        return $this->handleView($view);
    }

    /** @todo Faire l'appel à l'helper de token */
    #[Route(path: '/register', methods: 'POST')]
    #[ParamConverter('playerBody', converter:"fos_rest.request_body")]
    public function registerPlayer(PlayerBody $playerBody, ValidatorInterface $validator)
    {
        $errors = $validator->validate($playerBody);
        if (!empty($errors[0])) {
            throw new Exception(sprintf("%s : %s", $errors[0]->getMessage(), $errors[0]->getPropertyPath()), 1);
        }
        $this->usersBusiness->addPlayer($playerBody);
        
        $view = $this->view([
            "token" => "à faire"
        ]);
        return $this->handleView($view);
        
    }

    #[Route(path: '/{user}', methods: 'DELETE')]
    public function deletePlayer(Users $user)
    {
        $this->usersBusiness->deletePlayer($user);
        $view = $this->view();
        return $this->handleView($view);
    }
    
    #[Route(path: '/{user}', methods: 'PUT')]
    #[ParamConverter('playerBody', class: PlayerBody::class, converter: 'fos_rest.request_body')]
    public function modifyPlayer(Users $user, PlayerBody $playerBody)
    {
        $player = $this->usersBusiness->modifyPlayer($user, $playerBody);
        $view = $this->view($player);
        return $this->handleView($view);
    }

}
