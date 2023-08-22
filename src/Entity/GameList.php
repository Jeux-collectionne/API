<?php

namespace App\Entity;

use App\Repository\AddressRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/** @todo Faire le repo  pour cette entité */
#[ORM\Entity(repositoryClass: AddressRepository::class)]
class GameList
{
    #[Groups(['public', 'private'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['public', 'private'])]
    private ?int $userId;

    #[Groups(['public', 'private'])]
    #[ORM\ManyToOne(targetEntity: ListType::class, inversedBy:'list')]
    private ListType $type;
    
    #[ORM\ManyToOne(targetEntity: Users::class, inversedBy:'lists')]
    private Users $user;

    #[Groups(['public', 'private'])]
    #[ORM\OneToMany(targetEntity: ListElement::class, mappedBy:'gameList')]
    private ?Collection $games;

    public function __construct()
    {
        $this->games = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getUserId(): ?int
    {
        $this->userId = $this->user->getId();
        return $this->userId;
    }

    public function getType(): ?ListType
    {
        return $this->type;
    }
    public function setType(?ListType $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }
    public function setUser(?Users $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function getGames(): ?Collection
    {
        return $this->games;
    }
    /**
     * @param ListElement[] $games
     */
    public function addGames(array $games)
    {
        foreach ($games as $game) {
            if ($game instanceof ListElement) {
                $this->games->add($game);
            }else {
                throw new \Exception('Must be of type ListElement::class');
            }
        }
    }
}