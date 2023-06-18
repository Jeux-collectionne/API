<?php
namespace App\Business;

use App\Entity\Address;
use App\Entity\Event;
use App\Entity\Users;
use App\Repository\EventRepository;
use App\RequestBody\EventBody;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class EventBusiness {

    
    public function __construct(
        private EntityManagerInterface $em,
        private EventRepository $eventRepository,
    ){}

    public function addEvent(EventBody $eventBody, Users $player)
    {
        $event = new Event();
        $address = new Address();

        $address->setCity($eventBody->getAddress()->getCity())
                ->setZipCode($eventBody->getAddress()->getZipCode())
                ->setName($eventBody->getAddress()->getName());

        $this->em->persist($address);

        /** @todo Récup le user via le token à la place */
        $event->setName($eventBody->getName())
              ->setPlayers($eventBody->getPlayers())
              ->setMaxPlayers($eventBody->getMaxPlayers())
              ->setGame($eventBody->getGame())
              ->setDate($eventBody->getDate())
              ->setAddress($address)
              ->setUser($player);

        $this->em->persist($event);
        $this->em->flush();
    }

    public function getEvents()
    {
        return $this->eventRepository->findAll();
    }
}