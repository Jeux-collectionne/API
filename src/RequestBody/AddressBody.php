<?php

namespace App\RequestBody;

use Symfony\Component\Validator\Constraints as Assert;

class AddressBody
{
    #[Assert\NotBlank()]
    private ?string $city = null;
    
    #[Assert\NotBlank()]
    private ?int $zipCode = null;
    
    #[Assert\NotBlank()]
    private ?string $name = null;
    
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