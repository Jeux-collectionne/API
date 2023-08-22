<?php

namespace App\Entity;

use App\Repository\ListElementRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/** @todo Pas besoin de controller ni de business (peut-être une business). Tout intégrer à la business de GameList
 * -> à la création d'un game list, dans le request body, récup le tableau d'id de jeux et boucler dessus pour créer des éléments
 */
#[ORM\Entity(repositoryClass: ListElementRepository::class)]
class ListElement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

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
}