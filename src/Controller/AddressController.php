<?php

namespace App\Controller;

use App\RequestBody\AddressBody;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/** @todo Faire l'appel au business pour les réponses */
#[Route(path: '/addresses')]
class AddressController extends AbstractFOSRestController
{

    #[Route(path: '', methods: 'GET')]
    public function getAddresses()
    {

    }

    #[Route(path: '/{address}', methods: 'GET')]
    public function getAddress()
    {

    }

    #[Route(path: '/', methods: 'POST')]
    #[ParamConverter('addressBody', converter: 'fos_rest.request_body')]
    public function createAddress(AddressBody $addressBody)
    {

    }

    #[Route(path: '/{id}', methods: 'PUT')]
    #[ParamConverter('addressBody', converter: 'fos_rest.request_body')]
    public function modifyAddress(int $id, AddressBody $addressBody)
    {

    }

    #[Route(path: '/{id}', methods: 'DELETE')]
    public function deleteAddress(int $id)
    {
        
    }
    
}