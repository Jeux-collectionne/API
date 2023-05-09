<?php
namespace App\Business;

use App\Entity\Users;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class UsersBusiness {

    
    public function __construct(
        private EntityManagerInterface $em,
        private UsersRepository $usersRepository,
        private UserPasswordHasherInterface $pwdInterface)
    {
    }

    public function addPlayer(array $infos)
    {
        $player = new Users();

        $player->setLastName($infos['last_name']);
        $player->setFirstName($infos['first_name']);
        $player->setAge($infos['age'] ?? null);
        $player->setMail($infos['mail']);
        $player->setDescription($infos['description'] ?? null);

        $pwd = $this->pwdInterface->hashPassword(
            $player,
            $infos['password']
        );
        $player->setPassword($pwd);
        $this->em->persist($player);
        $this->em->flush();
    }

    public function getUsers()
    {
        return $this->usersRepository->findAll();
    }
}