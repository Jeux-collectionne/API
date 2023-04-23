<?php

namespace App\RequestBody;

class PlayerBody
{
    private ?string $username = '';
    private string  $lastName = '';
    private string  $firstName = '';
    private string  $mail = '';
    private ?int    $age = null;
    private string  $password = '';
    private ?string $description = null;
    

    public function getUsername(): string
    {
        return $this->username;
    }
    public function setUsername(string $username)
    {
        $this->username = $username;
    }
    public function getPassword(): string
    {
        return $this->password;
    }
    public function setPassword(string $password)
    {
        $this->password = $password;
    }
    public function getLastName(): string
    {
        return $this->lastName;
    }
    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;
    }
    public function getFirstName(): string
    {
        return $this->firstName;
    }
    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;
    }
    public function getMail(): string
    {
        return $this->mail;
    }
    public function setMail(string $mail)
    {
        $this->mail = $mail;
    }
    public function getAge(): ?int
    {
        return $this->age;
    }
    public function setAge(?int $age)
    {
        $this->age = $age;
    }
    public function getDescription(): ?string
    {
        return $this->description;
    }
    public function setDescription(?string $description)
    {
        $this->description = $description;
    }
}