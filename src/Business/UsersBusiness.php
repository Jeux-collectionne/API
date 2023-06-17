<?php
namespace App\Business;

use App\Entity\Users;
use App\Repository\UsersRepository;
use App\RequestBody\PlayerBody;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UsersBusiness {

    
    public function __construct(
        private EntityManagerInterface $em,
        private UsersRepository $usersRepository,
        private UserPasswordHasherInterface $pwdInterface
    ){}

    /**
     * @todo Check s'il l'adresse mail n'est pas déjà utilisée
     */
    public function addPlayer(PlayerBody $infos)
    {
        
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

    public function getUsers()
    {
        return $this->usersRepository->findAll();
    }

    public function deletePlayer($player)
    {
        $this->usersRepository->remove($player, true);
    }

    /** @todo */
    public function modifyPlayer(Users $player, PlayerBody $playerBody)
    {
        $player->setUsername($playerBody->getUsername())
               ->setLastName($playerBody->getLastName());
    }
}