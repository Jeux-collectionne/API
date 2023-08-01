<?php
namespace App\Business;

use App\Entity\Users;
use App\Repository\UsersRepository;
use App\RequestBody\PlayerBody;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UsersBusiness {

    
    public function __construct(
        private EntityManagerInterface $em,
        private UsersRepository $usersRepository,
        private UserPasswordHasherInterface $pwdInterface
    ){}

    public function addPlayer(PlayerBody $infos)
    {

        if ($this->usersRepository->findOneBy(['email' => $infos->getEmail()])) {
            throw new Exception('Cette adresse email est déjà utilisée');
        }

        $player = new Users();

        $player->setUsername($infos->getUsername());
        $player->setLastName($infos->getLastName());
        $player->setFirstName($infos->getFirstName());
        $player->setAge($infos->getAge());
        $player->setEmail($infos->getEmail());
        $player->setDescription($infos->getDescription());

        $pwd = $this->pwdInterface->hashPassword(
            $player,
            $infos->getPassword()
        );
        $player->setPassword($pwd);
        $this->em->persist($player);
        $this->em->flush();
    }

    /** @todo Ajouter une méthode dans le repo pour faire une pagination */
    public function getUsers()
    {
        $players = $this->usersRepository->findAll();
        return [
            "total_items" => count($players),
            "players" => $players
        ];
    }

    public function deletePlayer($player)
    {
        $this->usersRepository->remove($player, true);
    }

    public function modifyPlayer(Users $player, PlayerBody $playerBody)
    {
        empty($playerBody->getUsername())   ?: $player->setUsername($playerBody->getUsername());
        empty($playerBody->getPassword())   ?: $player->setPassword($playerBody->getPassword());
        empty($playerBody->getEmail())      ?: $player->setEmail($playerBody->getEmail());
        empty($playerBody->getFirstName())  ?: $player->setFirstName($playerBody->getFirstName());
        empty($playerBody->getLastName())   ?: $player->setLastName($playerBody->getLastName());
        empty($playerBody->getAge())        ?: $player->setAge($playerBody->getAge());
        empty($playerBody->getDescription())?: $player->setDescription($playerBody->getDescription());

        $this->em->persist($player);
        $this->em->flush();

        return $player;
    }
}