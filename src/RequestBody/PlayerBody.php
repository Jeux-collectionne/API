<?php

namespace App\RequestBody;

use Symfony\Component\Validator\Constraints as Assert;

class PlayerBody {

    #[Assert\NotBlank()]
    private string $username;

    #[Assert\NotBlank()]
    private string $password;

    #[Assert\NotBlank()]
    #[Assert\Email()]
    private string $email;

    #[Assert\NotBlank()]
    private string $firstName;
    
    #[Assert\NotBlank()]
    private string $lastName;

    #[Assert\NotBlank()]
    #[Assert\Type('integer')]
    private ?string $age;

    #[Assert\NotBlank()]
    private ?string $description;

    /**
     * @return mixed
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): self
    {
        $this->username = $username;
        return $this;
    }


    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }


    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }
    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }
    public function getAge()
    {
        return $this->age;
    }

    public function setAge(?int $age): self
    {
        $this->age = $age;
        return $this;
    }
    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }
}