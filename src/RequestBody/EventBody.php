<?php

namespace App\RequestBody;

use Symfony\Component\Validator\Constraints as Assert;
use DateTimeImmutable;

class EventBody
{
    #[Assert\NotBlank()]
    private ?string $name = null;

    private array $players = [];

    #[Assert\NotBlank()]
    private ?int $maxPlayers = null;

    #[Assert\NotBlank()]
    private ?int $game = null;

    #[Assert\NotBlank()]
    private ?DateTimeImmutable $date = null;

    #[Assert\NotBlank()]
    private ?AddressBody $Address = null;


    public function getName(): ?string
    {
        return $this->name;
    }
    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }


    public function getPlayers(): ?array
    {
        return $this->players;
    }
    public function setPlayers(?array $playersId): self
    {
        $this->players = $playersId;
        return $this;
    }
    
    public function getMaxPlayers(): ?int
    {
        return $this->maxPlayers;
    }
    public function setMaxPlayers(?int $maxPlayers): self
    {
        $this->maxPlayers = $maxPlayers;
        return $this;
    }

    public function getGame(): ?int
    {
        return $this->game;
    }
    public function setGame(?int $game): self
    {
        $this->game = $game;
        return $this;
    }

    public function getDate(): ?DateTimeImmutable
    {
        return $this->date;
    }
    public function setDate(?DateTimeImmutable $date): self
    {
        $this->date = $date;
        return $this;
    }

    public function getAddress(): ?AddressBody
    {
        return $this->Address;
    }
    public function setAddress(?AddressBody $address): self
    {
        $this->Address = $address;
        return $this;
    }
}