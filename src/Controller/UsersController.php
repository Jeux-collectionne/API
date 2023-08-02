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
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
#[Route(path: '/players')]
class UsersController extends AbstractFOSRestController
{
    public function __construct(private UsersBusiness $usersBusiness, private CustomHelper $helper){}

    #[IsGranted("ROLE_USER")]
    #[Route(path: '', methods: 'GET')]
    public function getAllUsers()
    {
        // Pour récup le user
        // dd($this->getUser());
        $players = $this->usersBusiness->getUsers();
        $view = $this->view($players)->setContext((new Context())->setGroups(['public']));
        return $this->handleView($view);
    }

    #[Route(path: '/search', methods: 'GET')]
    #[RequestParam(name: "username")]
    public function searchPlayerByUsername(?string $username)
    {
        $username === null ? dd($_GET['username']) : '';
        $player = $this->usersBusiness->searchPlayer($username);
        $view = $this->view($player);
        return $this->handleView($view);
    }

    #[Route(path: '/{user}', methods: 'GET')]
    public function getPlayer(Users $user)
    {
        $view = $this->view($user)->setContext((new Context())->setGroups(['public']));
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
