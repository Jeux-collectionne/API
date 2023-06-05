<?php

namespace App\Entity;

use App\Repository\EventRepository;
use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event {

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id;

    #[ORM\Column(type: Types::TEXT, nullable: false)]
    private ?string $name;

    #[ORM\Column(type: Types::INTEGER, nullable: false)]
    private ?int $players;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $maxPlayers;

    #[ORM\Column(nullable: false)]
    #[ORM\ManyToMany(targetEntity: Game::class)]
    private ?Game $game;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: false)]
    private ?DateTime $date;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(?int $id): self
    {
        $this->id = $id;
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
    public function getPlayers(): ?int
    {
        return $this->players;
    }
    public function addPlayer(): self
    {
        $this->players += 1;
        return $this;
    }
    public function removePlayer(): self
    {
        $this->players -= 1;
        return $this;
    }
    public function setPlayers(?int $players): self
    {
        $this->players = $players;
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
    public function getGame(): ?Game
    {
        return $this->game;
    }
    public function setGame(?Game $game): self
    {
        $this->game = $game;
        return $this;
    }
    public function getDate(): ?string
    {
        return $this->date;
    }
    public function setDate(?string $date): self
    {
        $this->date = $date;
        return $this;
    }
}