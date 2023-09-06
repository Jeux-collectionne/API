<?php

namespace App\Business;

use App\Entity\GameList;
use App\Entity\Users;
use App\Repository\GameListRepository;
use App\Service\BoardGameGeekService;
use Doctrine\ORM\EntityManagerInterface;

class GameListBusiness
{
    public function __construct(
        private EntityManagerInterface $em,
        private BoardGameGeekService $bggService,
        private GameListRepository $gameListRepository
    ){}

    public function getGamesData(array $gamesId): array
    {
        // todo
        $result = $this->bggService->getGamesById($gamesId);
        $gamesInfo = [];
        foreach ($result['item'] as $item) {
            if (!isset($gamesInfo[$item['@attributes']['id']])) {
                $name = null;
                foreach ($item['name'] as $itemName) {
                    if (isset($itemName['@attributes']['type']) && $itemName['@attributes']['type'] === 'primary' && $name === null) {
                        $name = $itemName['@attributes']['value'];
                        break;
                    }
                }
                $gamesInfo[$item['@attributes']['id']] = [
                    'id'                => $item['@attributes']['id'] ?? null,
                    'name'              => $name,
                    'year_published'    => $item['yearpublished']['@attributes']['value'],
                    'img'               => $item['image'],
                    'thumbnail'         => $item['thumbnail']
                ];
            }
        }
        return $gamesInfo;
    }
    public function getGameLists()
    {
        return $this->gameListRepository->findAll();
    }

    public function getPlayerGameLists(Users $player)
    {
        $lists = $player->getLists()->toArray();

        $gamesId = [];
        foreach ($lists as $list) {
            foreach ($list->getGames() as $game) {
                $gamesId[] = $game->getId();
            }
        }
        $gamesData = $this->getGamesData($gamesId);

        $result = $this->buildLists($lists, $gamesData);
        
        return $result;
    }

    /**
     * @param GameList[] $lists
     * @param array $gamesData Provided by BoardGameGeek
     */
    public function buildLists(array $lists, array $gamesData): array
    {
        $listsResult = [];
        foreach ($lists as $list) {
            $listGames = [];
            foreach($list->getGames() as $game){
                $listGames[] = $gamesData[$game->getId()] ?? null;
            }
            $listsResult[] = [
                'id' => $list->getId(),
                'user_id' => $list->getUser()->getId(),
                'type' => $list->getType()->getType(),
                'games' => $listGames
            ];
        }
        return $listsResult;
    }

    public function getPlayerGameListsType(Users $player, string $type)
    {
        $result = [];
        $lists = $this->gameListRepository->getPlayerGameListOfType($player, $type);
        foreach ($lists as $list) {
            foreach ($list->getGames() as $game) {
                $gamesId[] = $game->getId();
            }
        }
        $gamesData = $this->getGamesData($gamesId);
        $result = $this->buildLists($lists, $gamesData);
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