<?php

namespace App\Controller;

use App\Business\EventBusiness;
use App\RequestBody\EventBody;
use App\RequestBody\PlayerBody;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

#[Route('/event', name: 'event_controller')]
class EventController extends AbstractController
{
    public function __construct(
        private EventBusiness $eventBusiness
    ){}

    #[Route('', methods: 'GET')]
    public function getEvents(): Response
    {
        return $this->json([
            'test' => 'Hello World'
        ]);
    }

    #[Route('', methods: 'POST')]
    #[ParamConverter("event", class: EventBody::class, converter:"fos_rest.request_body")]
    public function test(EventBody $event){
        dd($event);
    }
}