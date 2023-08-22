<?php

namespace App\Controller;

use App\Business\EventBusiness;
use App\Entity\Event;
use App\Entity\Users;
use App\RequestBody\EventBody;
use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/** @todo revoir tout le truc en prenant le user dans le token au lieu de celui dans l'url */
#[Route(path: '/events', name: 'event_controller')]
class EventController extends AbstractFOSRestController
{
    public function __construct(
        private EventBusiness $eventBusiness
    ){}

    #[Route(path: '', methods: 'GET')]
    public function getEvents()
    {
        $events = $this->eventBusiness->getEvents();
        $view = $this->view($events)->setContext((new Context())->setGroups(['public-event']));
        return $this->handleView($view);
    }

    #[Route(path: '/{event}', methods: 'GET')]
    public function getEvent(Event $event)
    {
        dd($this->getUser());
    }

    #[Route(path: '/{player}', methods: 'POST')]
    #[ParamConverter("eventBody", class: EventBody::class, converter: "fos_rest.request_body")]
    public function createEvent(Users $player, EventBody $eventBody)
    {
        $this->eventBusiness->addEvent($eventBody, $player);
        $view = $this->view();
        return $this->handleView($view);
    }

    #[Route(path: '/join/{event}/{player}', methods: 'PUT')]
    public function joinEvent(Event $event, Users $player){
        $this->eventBusiness->joinEvent($event, $player);
        $view = $this->view();
        return $this->handleView($view);
    }
    
    #[Route(path: '/{event}', methods: 'PUT')]
    public function modifyEvent(Event $event){
        dd($this->getUser());
    }
    
    #[Route(path: '/leave/{event}/{player}', methods: 'PUT')]
    public function leaveEvent(Event $event, Users $player){
        $this->eventBusiness->leaveEvent($event, $player);
        $view = $this->view();
        return $this->handleView($view);
    }

    /** @todo Vérifier que c'est bien celui qui à créé l'event qui veut le supprimer */
    #[Route(path: '/{event}', methods: 'DELETE')]
    public function deleteEvent(Event $event){
        $this->eventBusiness->deleteEvent($event);
        $view = $this->view();
        return $this->handleView($view);
    }
}