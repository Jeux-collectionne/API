<?php

namespace App\Controller;

use App\Business\AddressBusiness;
use App\Entity\Address;
use App\RequestBody\AddressBody;
use Exception;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route(path: '/addresses')]
class AddressController extends AbstractFOSRestController
{

    public function __construct(private AddressBusiness $addressBusiness)
    {}

    #[Route(path: '', methods: 'GET')]
    public function getAddresses()
    {
        $addresses = $this->addressBusiness->getAddresses();
        $view = $this->view($addresses);
        return $this->handleView($view);
    }

    #[Route(path: '/{address}', methods: 'GET')]
    public function getAddress(Address $address)
    {
        $view = $this->view($address);
        return $this->handleView($view);
    }

    #[Route(path: '', methods: 'POST')]
    #[ParamConverter('addressBody', converter: 'fos_rest.request_body')]
    public function createAddress(AddressBody $addressBody, ValidatorInterface $validator)
    {
        $errors = $validator->validate($addressBody);
        if (!empty($errors[0])) {
            throw new Exception(sprintf("%s : %s", $errors[0]->getMessage(), $errors[0]->getPropertyPath()), 1);
        }
        $address = $this->addressBusiness->createAddress($addressBody);
        $view = $this->view($address);
        return $this->handleView($view);
    }

    #[Route(path: '/{address}', methods: 'PUT')]
    #[ParamConverter('addressBody', converter: 'fos_rest.request_body')]
    public function modifyAddress(Address $address, AddressBody $addressBody)
    {
        $address = $this->addressBusiness->modifyAddress($addressBody, $address);
        $view = $this->view($address);
        return $this->handleView($view);
    }

    #[Route(path: '/{address}', methods: 'DELETE')]
    public function deleteAddress(Address $address)
    {
        $this->addressBusiness->deleteAddress($address);
        $view = $this->view();
        return $this->handleView($view);
    }
    
}