<?php

namespace App\Entity;

use App\Repository\RoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoleRepository::class)]
class Role
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $roleName = null;

    #[ORM\Column]
    private ?bool $status = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'role')]
    private Collection $users;

    /**
     * @var Collection<int, UserSecurity>
     */
    #[ORM\ManyToMany(targetEntity: UserSecurity::class, mappedBy: 'Role')]
    private Collection $userSecurities;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->userSecurities = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoleName(): ?string
    {
        return $this->roleName;
    }

    public function setRoleName(string $roleName): static
    {
        $this->roleName = $roleName;

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): static
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addRole($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            $user->removeRole($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, UserSecurity>
     */
    public function getUserSecurities(): Collection
    {
        return $this->userSecurities;
    }

    public function addUserSecurity(UserSecurity $userSecurity): static
    {
        if (!$this->userSecurities->contains($userSecurity)) {
            $this->userSecurities->add($userSecurity);
            $userSecurity->addRole($this);
        }

        return $this;
    }

    public function removeUserSecurity(UserSecurity $userSecurity): static
    {
        if ($this->userSecurities->removeElement($userSecurity)) {
            $userSecurity->removeRole($this);
        }

        return $this;
    }
}
