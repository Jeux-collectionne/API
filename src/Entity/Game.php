<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game {

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id;

    #[ORM\Column(type: Types::INTEGER, nullable: false)]
    private ?int $boardGameId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }
    public function getBoardGameId(): ?int
    {
        return $this->boardGameId;
    }

    public function setBoardGameId(?int $boardGameId): self
    {
        $this->boardGameId = $boardGameId;
        return $this;
    }
}