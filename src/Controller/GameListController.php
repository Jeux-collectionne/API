<?php

namespace App\Controller;

use App\Business\GameListBusiness;
use App\Entity\GameList;
use App\Entity\Users;
use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(path: '/game-lists', name: 'gameList_controller')]
class GameListController extends AbstractFOSRestController
{
    public function __construct(
        private GameListBusiness $gameListBusiness
    ){}
    
    #[Route(path: '', methods: 'GET')]
    public function getGameLists()
    {
        $gameLists = $this->gameListBusiness->getGameLists();
        $view = $this->view($gameLists)->setContext((new Context())->setGroups(['public']));
        return $this->handleView($view);
    }
    
    #[Route(path: '/player-type/{player}/{type}', methods: 'GET')]
    public function getPlayerGameListsType(Users $player, string $type)
    {
        $gameLists = $this->gameListBusiness->getPlayerGameListsType($player, $type);
        $view = $this->view($gameLists)->setContext((new Context())->setGroups(['public']));
        return $this->handleView($view);
    }

    #[Route(path: '/player/{player}', methods: 'GET')]
    public function getPlayerGameLists(Users $player)
    {
        $gameLists = $this->gameListBusiness->getPlayerGameLists($player);
        $view = $this->view($gameLists)->setContext((new Context())->setGroups(['public']));
        return $this->handleView($view);
    }

    
    #[Route(path: '/{gameList}', methods: 'GET')]
    public function getGameList(GameList $gameList)
    {
        $view = $this->view($gameList)->setContext((new Context())->setGroups(['public']));
        return $this->handleView($view);
    }
    #[IsGranted("ROLE_USER")]
    #[Route(path: '/{gameList}', methods: 'DELETE')]
    public function deleteGameList(GameList $gameList)
    {
        $user = $this->getUser();
        $this->gameListBusiness->deleteGameList($user, $gameList);
        $view = $this->view($gameList)->setContext((new Context())->setGroups(['public']));
        return $this->handleView($view);
    }

    /** @todo Ajouter la méthode d'ajout de liste */
    /** @todo Ajouter la méthode de modification de liste */
    /** @todo Ajouter la méthode de suppréssion de liste */

    // #[Route(path: '/{player}', methods: 'POST')]
    // #[ParamConverter("gameListBody", class: gameListBody::class, converter: "fos_rest.request_body")]
    // public function creategameList(Users $player, gameListBody $gameListBody)
    // {
    //     $this->gameListBusiness->addgameList($gameListBody, $player);
    //     $view = $this->view();
    //     return $this->handleView($view);
    // }

    
}