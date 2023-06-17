<?php

namespace App\Controller;

use App\Business\EventBusiness;
use App\Entity\Event;
use App\RequestBody\EventBody;
use FOS\RestBundle\Controller\Annotations\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/** @todo Faire l'appel au business pour les réponses */
#[Route(path: '/events', name: 'event_controller')]
class EventController extends AbstractController
{
    public function __construct(
        private EventBusiness $eventBusiness
    ){}

    #[Route(path: '', methods: 'GET')]
    public function getEvents(): Response
    {
        return $this->json([
            'test' => 'Hello World'
        ]);
    }

    #[Route(path: '', methods: 'POST')]
    #[ParamConverter("event", class: EventBody::class, converter:"fos_rest.request_body")]
    public function created(EventBody $event){
        dd($event);
    }

    #[Route(path: '/{event}', methods: 'PUT')]
    public function modifyEvent(Event $event){
        dd($event);
    }

    #[Route(path: '/{event}', methods: 'DELETE')]
    public function deleteEvent(Event $event){
        dd($event);
    }
}