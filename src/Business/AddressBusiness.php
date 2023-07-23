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
    public function modifyAddress(AddressBody $addressBody, Address $address)
    {
        !$addressBody->getCity()    ?: $address->setCity($addressBody->getCity());
        !$addressBody->getZipCode() ?: $address->setZipCode($addressBody->getZipCode());
        !$addressBody->getName()    ?: $address->setName($addressBody->getName());

        $this->em->persist($address);
        $this->em->flush();
    }

    /**
     * Deletes the given address
     */
    public function deleteAddress(Address $address): void
    {
        $this->addressRepository->remove($address);
        $this->em->flush();
    }
}