<?php

namespace App\Business;

use App\Entity\GameList;
use App\Entity\Users;
use App\Repository\GameListRepository;
use Doctrine\ORM\EntityManagerInterface;

class GameListBusiness
{
    public function __construct(
        private EntityManagerInterface $em,
        private GameListRepository $gameListRepository
    ){}

    public function getGameLists()
    {
        return $this->gameListRepository->findAll();
    }

    public function getPlayerGameLists(Users $player)
    {
        return $player->getLists();
    }

    public function getPlayerGameListsType(Users $player, string $type)
    {
        $result = [];
        $result = $this->gameListRepository->getPlayerGameListOfType($player, $type);
        return $result;
    }

    /**
     * Delete a gamelist belonging to the authenticated user by its given id
     * @throws Exception
     */
    public function deleteGameList(Users $user, GameList $gameList): void
    {
        if ($user === $gameList->getUser()) {
            $this->em->remove($gameList);
            $this->em->flush();
        }else {
            throw new \Exception("Couldn't delete this game list because it doesn't belong to you");
        }
    }
}