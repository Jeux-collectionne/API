<?php

namespace App\Business;

use App\Repository\AddressRepository;
use Doctrine\ORM\EntityManagerInterface;

class AddressBusiness
{
    public function __construct(
        private EntityManagerInterface $em,
        private AddressRepository $addressRepository
    ){}

    /**
     * Returns every address
     */
    public function getAddresses(): array
    {
        return $this->addressRepository->findAll();
    }
}