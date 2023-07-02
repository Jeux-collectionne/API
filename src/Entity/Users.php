<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
class Users implements PasswordAuthenticatedUserInterface, UserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['public', 'private'])]
    private ?int $id = null;

    #[Groups(['public', 'private'])]
    #[ORM\Column(type: Types::STRING, length: 255)]
    private ?string $username = null;

    #[Groups(['public', 'private'])]
    #[ORM\Column(type: Types::STRING, length: 255)]
    private ?string $lastName = null;

    #[Groups(['public', 'private'])]
    #[ORM\Column(type: Types::STRING, length: 255)]
    private ?string $firstName = null;

    #[Groups(['public', 'private'])]
    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[Groups(['public', 'private'])]
    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $age = null;

    #[Groups(['public', 'private'])]
    #[ORM\Column(type: Types::STRING, length: 255, unique: true)]
    private ?string $email = null;

    #[Groups(['private'])]
    #[ORM\Column(type: Types::TEXT, length: 460)]
    private ?string $password = null;

    #[Groups(['public', 'private'])]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\OneToOne(targetEntity: Address::class)]
    private ?Address $Address;

    #[Groups(['public', 'private'])]
    #[ORM\ManyToMany(targetEntity: Game::class)]
    private ?Collection $games;

    /**
     * The public representation of the user (e.g. a username, an email address, etc.)
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAddress(): ?Address
    {
        return $this->Address;
    }
    public function setAddress(?string $address): self
    {
        $this->Address = $address;
        return $this;
    }

    public function getGames(): Collection
    {
        return $this->games;
    }

    public function setGames(array $games): self
    {
        $this->games->clear();
        if ($games !== null) {
            foreach ($games as $game) {
                $this->games->add($game);
            }
        }
        return $this;
    }

    public function addGame(Game $game): self
    {
        $this->games->add($game);
        return $this;
    }
    
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}
