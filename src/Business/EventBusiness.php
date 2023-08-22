<?php
namespace App\Business;

use App\Entity\Address;
use App\Entity\Event;
use App\Entity\Users;
use App\Repository\EventRepository;
use App\Repository\UsersRepository;
use App\RequestBody\EventBody;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class EventBusiness {

    
    public function __construct(
        private EntityManagerInterface $em,
        private EventRepository $eventRepository,
        private UsersRepository $usersRepository
    ){}

    public function addEvent(EventBody $eventBody, Users $player)
    {
        $event = new Event();
        $address = new Address();
        $players = [];
        $eventPlayers = $eventBody->getPlayers();
        foreach ($eventPlayers as $playerId) {
            $player = $this->usersRepository->find($playerId);
            $player !== null ? $players[] = $player : null;
        }
        $address->setCity($eventBody->getAddress()->getCity())
        ->setZipCode($eventBody->getAddress()->getZipCode())
        ->setName($eventBody->getAddress()->getName());
        
        $this->em->persist($address);
        
        /** @todo Récup le user via le token à la place */
        $event->setName($eventBody->getName())
        ->setMaxPlayers($eventBody->getMaxPlayers())
        ->addPlayers($players)
        ->setGame($eventBody->getGame())
        ->setDate($eventBody->getDate())
        ->setAddress($address)
        ->setEventCreator($player);
        $this->em->persist($event);
        $this->em->flush();
    }

    public function getEvents()
    {
        return $this->eventRepository->findAll();
    }

    public function joinEvent(Event $event, Users $player): void
    {
        $event->addPlayers($player);
        $this->em->persist($event);
        $this->em->flush();
        
    }

    public function leaveEvent(Event $event, Users $player): void
    {
        $event->removePlayer($player);
        $this->em->flush();
    }

    public function deleteEvent(Event $event)
    {
        $this->eventRepository->remove($event);
        $this->em->flush();
    }
}