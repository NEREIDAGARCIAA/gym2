<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $pass = null;

    /**
     * @var Collection<int, NewRoutine>
     */
    #[ORM\OneToMany(targetEntity: NewRoutine::class, mappedBy: 'usersRoutine')]
    private Collection $userRoutine;

    /**
     * @var Collection<int, Role>
     */
    #[ORM\ManyToMany(targetEntity: Role::class, inversedBy: 'users')]
    private Collection $role;

    public function __construct()
    {
        $this->userRoutine = new ArrayCollection();
        $this->role = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPass(): ?string
    {
        return $this->pass;
    }

    public function setPass(?string $pass): static
    {
        $this->pass = $pass;

        return $this;
    }

    /**
     * @return Collection<int, NewRoutine>
     */
    public function getUserRoutine(): Collection
    {
        return $this->userRoutine;
    }

    public function addUserRoutine(NewRoutine $userRoutine): static
    {
        if (!$this->userRoutine->contains($userRoutine)) {
            $this->userRoutine->add($userRoutine);
            $userRoutine->setUsersRoutine($this);
        }

        return $this;
    }

    public function removeUserRoutine(NewRoutine $userRoutine): static
    {
        if ($this->userRoutine->removeElement($userRoutine)) {
            // set the owning side to null (unless already changed)
            if ($userRoutine->getUsersRoutine() === $this) {
                $userRoutine->setUsersRoutine(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Role>
     */
    public function getRole(): Collection
    {
        return $this->role;
        
    }

    public function addRole(Role $role): static
    {
        if (!$this->role->contains($role)) {
            $this->role->add($role);
        }

        return $this;
    }

    public function removeRole(Role $role): static
    {
        $this->role->removeElement($role);

        return $this;
    }
}
