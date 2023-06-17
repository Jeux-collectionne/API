<?php

namespace App\RequestBody;

use DateTime;

class EventBody
{
    private ?string $name;

    private ?int $players;

    private ?int $maxPlayers;

    private ?int $game;

    private ?DateTime $date;

    private ?AddressBody $Address;


    public function getName(): ?string
    {
        return $this->name;
    }
    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }


    public function getPlayers(): ?int
    {
        return $this->players;
    }
    public function setPlayers(?int $players): self
    {
        if (null === $players) {
            $this->players = 1;
        }else {
            $this->players = $players;
        }
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

    public function getDate(): ?DateTime
    {
        return $this->date;
    }
    public function setDate(?DateTime $date): self
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