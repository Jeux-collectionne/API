<?php

namespace App\Entity;

use App\Repository\ListElementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ListElementRepository::class)]
class ListElement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /** @todo Check les OneToMany etc ici et dans Users -> ne pas oublier de faire les migrations */
    #[ORM\ManyToOne(targetEntity: GameList::class, inversedBy:'id')]
    private GameList $gameList;

    #[Groups(['public', 'private'])]
    #[ORM\Column(type: Types::INTEGER)]
    private ?int $gameId;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getGameList(): ?GameList
    {
        return $this->gameList;
    }
    public function setGameList(?GameList $gameList): self
    {
        $this->gameList = $gameList;
        return $this;
    }

    public function getGameId(): ?int
    {
        return $this->gameId;
    }
    public function setGameId(?int $gameId): self
    {
        $this->gameId = $gameId;
        return $this;
    }
    public function addGameId(int $gameId): self
    {
        $this->gameId[] = $gameId;
        return $this;
    }
}