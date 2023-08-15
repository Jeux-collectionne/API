<?php

namespace App\Entity;

use App\Repository\AddressRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/** @todo Faire le repos pour cette entité */
#[ORM\Entity(repositoryClass: AddressRepository::class)]
class ListType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['public', 'private'])]
    #[ORM\Column(type: Types::TEXT, nullable:false)]
    private ?string $type;

    #[ORM\OneToMany(targetEntity: GameList::class, mappedBy: 'type')]
    private ?Collection $list;

    public function __construct()
    {
        $this->list = new ArrayCollection();
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

    public function getType(): ?string
    {
        return $this->type;
    }
    public function setType(?string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getList(): ?Collection
    {
        return $this->list;
    }

}