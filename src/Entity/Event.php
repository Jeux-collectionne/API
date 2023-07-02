<?php

namespace App\Entity;

use App\Repository\EventRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event {

    #[Groups(["public"])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id;

    #[Groups(["public"])]
    #[ORM\Column(type: Types::TEXT, nullable: false)]
    private ?string $name;

    /** @todo fix ça: ne peut pas faire addPlayer parce pas instancié */
    #[Groups(["public"])]
    #[ORM\ManyToMany(targetEntity: Users::class)]
    private ?Collection $players;

    #[Groups(["public"])]
    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $maxPlayers;

    #[Groups(["public"])]
    #[ORM\Column(type: Types::INTEGER, nullable: false)]
    private ?int $game;

    #[Groups(["public"])]
    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: false)]
    private ?DateTimeImmutable $date;

    #[Groups(["public"])]
    #[ORM\OneToOne(targetEntity: Address::class)]
    private ?Address $Address;

    #[Groups(["public"])]
    #[ORM\ManyToOne(targetEntity: Users::class)]
    private ?Users $eventCreator;

    public function __construct()
    {
        $this->players = new ArrayCollection();
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
    public function getName(): ?string
    {
        return $this->name;
    }
    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }
    public function getPlayers(): ?Collection
    {
        return $this->players;
    }
    /**
     * @param null|Users|Users[] players
     */
    public function addPlayers(null|Users|array $players): self
    {
        if ($players === null) {
            return $this;
        }
        if ($players instanceof Users) {
            if ($this->getPlayers()->contains($players)) {
                throw new \Exception(sprintf('%s is already in this event', $players->getUsername()));
            }
            if ($this->maxPlayers > $this->getPlayersNb()) {
                $this->players->add($players);
            }else {
                throw new \Exception('This event is already full');
            }
            return $this;
        }
        if (is_array($players)) {
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
        }
        
        return $this;
    }
    public function removePlayer(Users $player): self
    {
        $this->players->removeElement($player) ?: throw new \Exception('This player was not in this event in the first place');
        return $this;
    }
    #[Groups("public")]
    public function getPlayersNb(): ?int
    {
        return count($this->players->toArray());
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

    public function addPlayer(Users $player): self
    {
        if (!$this->players->contains($player)) {
            $this->players->add($player);
        }

        return $this;
    }

    #[Groups(["public"])]
    public function getEventCreator(): ?Users
    {
        return $this->eventCreator;
    }

    #[Groups(["public"])]
    public function setEventCreator(?Users $eventCreator): self
    {
        $this->eventCreator = $eventCreator;

        return $this;
    }
}