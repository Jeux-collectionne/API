<?php

namespace App\RequestBody;

use Symfony\Component\Validator\Constraints as Assert;

class PlayerBody {

    #[Assert\NotBlank()]
    private $username;

    #[Assert\NotBlank()]
    private $password;

    #[Assert\NotBlank()]
    #[Assert\Email()]
    private $email;

    // Mettre en snake case dans le body json
    #[Assert\NotBlank()]
    private $firstName;
    
    #[Assert\NotBlank()]
    private $lastName;

    #[Assert\NotBlank()]
    #[Assert\Type('integer')]
    private $age;

    #[Assert\NotBlank()]
    private $description;

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }


    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): void
    {
        $this->firstName = $firstName;
    }
    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): void
    {
        $this->lastName = $lastName;
    }
    public function getAge()
    {
        return $this->age;
    }

    public function setAge(?int $age): void
    {
        $this->age = $age;
    }
    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }
}