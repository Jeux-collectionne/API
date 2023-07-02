<?php

namespace App\Entity;

use App\Repository\AddressRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: AddressRepository::class)]
class Address
{
    #[Groups(["public-event"])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(["public-event"])]
    #[ORM\Column(type: Types::TEXT, nullable:false)]
    private ?string $city;

    #[Groups(["public-event"])]
    #[ORM\Column(type: Types::INTEGER, nullable:false)]
    private ?int $zipCode;

    #[Groups(["public-event"])]
    #[ORM\Column(type: Types::TEXT, nullable:true)]
    private ?string $name;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }
    public function setCity(?string $city): self
    {
        $this->city = $city;
        return $this;
    }
    public function getZipCode(): ?int
    {
        return $this->zipCode;
    }
    public function setZipCode(?int $zipCode): self
    {
        $this->zipCode = $zipCode;
        return $this;
    }
    public function getName(): ?string
    {
        return $this->name;
    }
    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }
}