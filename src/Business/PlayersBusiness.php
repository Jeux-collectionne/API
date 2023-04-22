<?php
namespace App\Business;

use App\Entity\Players;
use App\Repository\PlayersRepository;
use Doctrine\ORM\EntityManagerInterface;

class PlayersBusiness {

    
    public function __construct(private EntityManagerInterface $em, private PlayersRepository $playersRepository)
    {
    }

    public function addPlayer(Players $player)
    {
        $this->em->persist($player);
        $this->em->flush();
    }

    public function getPlayers()
    {
        return $this->playersRepository->findAll();
    }
    
    public function getPlayer(
        int $id
        )
    {
        return $this->playersRepository->find($id);
    }
}