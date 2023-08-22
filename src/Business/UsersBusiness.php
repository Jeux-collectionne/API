<?php
namespace App\Business;

use App\Entity\Users;
use App\Repository\UsersRepository;
use App\RequestBody\PlayerBody;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UsersBusiness {

    
    public function __construct(
        private EntityManagerInterface $em,
        private UsersRepository $usersRepository,
        private UserPasswordHasherInterface $pwdInterface,
        private ValidatorInterface $validator,
        private JWTTokenManagerInterface $tokenManager
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

        return $player;
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

    public function deletePlayer(Users $player)
    {
        $this->usersRepository->remove($player, true);
    }

    public function modifyPlayer(Users $player, PlayerBody $playerBody)
    {
        $result = [];

        empty($playerBody->getUsername())   ?: $player->setUsername($playerBody->getUsername());
        empty($playerBody->getEmail())      ?: $player->setEmail($playerBody->getEmail());
        empty($playerBody->getFirstName())  ?: $player->setFirstName($playerBody->getFirstName());
        empty($playerBody->getLastName())   ?: $player->setLastName($playerBody->getLastName());
        empty($playerBody->getAge())        ?: $player->setAge($playerBody->getAge());
        empty($playerBody->getDescription())?: $player->setDescription($playerBody->getDescription());

        // Setting up the email address after verification and returning the new token
        if (!empty($playerBody->getEmail())) {
            $emailError = $this->validator->validatePropertyValue($playerBody, 'email', $playerBody->getEmail());
            if (count($emailError) > 0) {
                throw new \Exception((string) $emailError);
            }
            $player->setEmail($playerBody->getEmail());
        }

        // Setting up the password after it being hashed
        if (!empty($playerBody->getPassword())) {
            $pwdError = $this->validator->validatePropertyValue($playerBody, 'password', $playerBody->getPassword());
            if (count($pwdError) > 0) {
                throw new \Exception((string) $pwdError);
            }
            $pwd = $this->pwdInterface->hashPassword(
                $player,
                $playerBody->getPassword()
            );
            $player->setPassword($pwd);
        }

        $this->em->persist($player);
        $this->em->flush();

        empty($playerBody->getEmail()) ?: $result['token'] = $this->tokenManager->create($player);
        $result['player'] = $player;
        return $result;
    }

    public function searchPlayer(?string $username): array
    {
        $players= [];

        !$username ?: $players = $this->usersRepository->searchPlayerByUsername($username);

        return [
            'total_items'   => count($players),
            'players'       => $players
        ];
    }
}