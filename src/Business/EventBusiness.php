<?php
namespace App\Business;

use App\Entity\Event;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class EventBusiness {

    
    public function __construct(
        private EntityManagerInterface $em,
        private EventRepository $eventRepository,
        ){}

    public function addEvent(array $infos)
    {
        $player = new Event();

        $this->em->persist($player);
        $this->em->flush();
    }

    public function getEvents()
    {
        return $this->eventRepository->findAll();
    }
}