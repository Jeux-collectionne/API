<?php

namespace App\Entity;

use App\Repository\EventRepository;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use PhpParser\Node\Expr\Instanceof_;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event {

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id;

    #[ORM\Column(type: Types::TEXT, nullable: false)]
    private ?string $name;

    /** @todo fix ça: ne peut pas faire addPlayer parce pas instancié */
    #[ORM\ManyToMany(targetEntity: Users::class)]
    private ?PersistentCollection $players;

    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $maxPlayers;

    #[ORM\Column(type: Types::INTEGER, nullable: false)]
    private ?int $game;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: false)]
    private ?DateTimeImmutable $date;

    #[ORM\OneToOne(targetEntity: Address::class)]
    private ?Address $Address;

    #[ORM\ManyToOne(targetEntity: Users::class)]
    private ?Users $eventCreator;

    
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
    public function getPlayers(): ?PersistentCollection
    {
        return $this->players;
    }
    /**
     * @param null|Users|Users[] players
     */
    public function addPlayers(null|Users|array $players): self
    {
        if ($players instanceof Users) {
            $this->players->add($players);
            return $this;
        }
        foreach ($players as $player) {
            if (!$player instanceof Users) {
                throw new \Exception('player must be of instance \'Users\'');
            }
            if ($this->maxPlayers > $this->getPlayersNb()) {
                if ($this->getPlayers()->contains($player)) {
                    throw new \Exception(sprintf('%s is already in this event', $player->getUsername()));
                }
                $this->players?->add($player);
            }else {
                throw new \Exception('This event is already full');
            }
        }
        
        return $this;
    }
    public function removePlayer(Users $player): self
    {
        $this->players->removeElement($player) ?: throw new \Exception('This player was not in this event in the first place');
        return $this;
    }
    // public function setPlayers(?Users... $players): self
    // {
    //     $playersCollection = new PersistentCollection();
    //     if ($players !== null) {
    //         foreach ($players as $player) {
    //             $playersCollection->add($player);
    //         }
    //     }
    //     $this->players = $playersCollection;
    //     return $this;
    // }
    public function getPlayersNb(): ?int
    {
        return count($this->getPlayers()->toArray());
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
    public function getAddress(): ?Address
    {
        return $this->Address;
    }
    public function setAddress(?Address $Address): self
    {
        $this->Address = $Address;
        return $this;
    }
    public function getUser(): ?Users
    {
        return $this->eventCreator;
    }
    public function setUser(?Users $player): self
    {
        $this->eventCreator = $player;
        return $this;
    }
}