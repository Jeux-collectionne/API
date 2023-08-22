<?php

namespace App\RequestBody;

use Symfony\Component\Validator\Constraints as Assert;

class PlayerBody {

    #[Assert\NotBlank()]
    private ?string $username = null;

    #[Assert\NotBlank()]
    #[Assert\Length(min: 6)]
    private ?string $password = null;

    #[Assert\NotBlank()]
    #[Assert\Email()]
    private ?string $email = null;

    #[Assert\NotBlank()]
    private ?string $firstName = null;
    
    #[Assert\NotBlank()]
    private ?string $lastName = null;

    private ?string $age = null;

    private ?string $description = null;

    public function getUsername(): ?string
    {
        return $this->username;
    }
    public function setUsername(?string $username): self
    {
        $this->username = $username;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }
    public function setPassword($password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }
    public function setEmail(?string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }
    public function setFirstName(?string $firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }
    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }
    public function setAge(?int $age): self
    {
        $this->age = $age;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }
    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }
}