<?php

namespace App\Entity;

use App\Repository\PlayersRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PlayersRepository::class)]
class Players
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['public', 'private'])]
    private ?int $id = null;

    #[Groups(['public', 'private'])]
    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[Groups(['public', 'private'])]
    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[Groups(['public', 'private'])]
    #[ORM\Column(nullable: true)]
    private ?int $age = null;

    #[Groups(['public', 'private'])]
    #[ORM\Column(length: 255)]
    private ?string $mail = null;

    #[Groups(['private'])]
    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[Groups(['public', 'private'])]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

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

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

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
