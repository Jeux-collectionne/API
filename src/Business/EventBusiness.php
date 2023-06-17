<?php
namespace App\Business;

use App\Entity\Event;
use App\Repository\EventRepository;
use App\RequestBody\EventBody;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class EventBusiness {

    
    public function __construct(
        private EntityManagerInterface $em,
        private EventRepository $eventRepository,
    ){}

    public function addEvent(EventBody $eventBody)
    {
        $event = new Event();

        $event->setName($eventBody->getName())
              ->setPlayers($eventBody->getPlayers())
              ->setMaxPlayers($eventBody->getMaxPlayers())
              ->setGame($eventBody->getGame())
              ->setDate($eventBody->getDate())
              ->setAddress($eventBody->getAddress());
              
        $this->em->persist($event);
        $this->em->flush();
    }

    public function getEvents()
    {
        return $this->eventRepository->findAll();
    }
}