<?php

namespace App\Business;

use App\Entity\Address;
use App\Repository\AddressRepository;
use App\RequestBody\AddressBody;
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

    /**
     * Modifies the given address with the given infos
     */
    public function modifyAddress(AddressBody $addressBody, Address $address): Address
    {
        empty($addressBody->getCity())    ?: $address->setCity($addressBody->getCity());
        empty($addressBody->getZipCode()) ?: $address->setZipCode($addressBody->getZipCode());
        empty($addressBody->getName())    ?: $address->setName($addressBody->getName());

        $this->em->persist($address);
        $this->em->flush();

        return $address;
    }

    /**
     * Deletes the given address
     */
    public function deleteAddress(Address $address): void
    {
        $this->addressRepository->remove($address);
        $this->em->flush();
    }

    /**
     * Creates an address
     */
    public function createAddress(AddressBody $addressBody): Address
    {
        $address = new Address();

        $address->setCity($addressBody->getCity())
        ->setZipCode($addressBody->getZipCode())
        ->setName($addressBody->getName());

        $this->em->persist($address);
        $this->em->flush();
        return $address;
    }
}