<?php

namespace App\Entity;

use App\Repository\NewRoutineRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NewRoutineRepository::class)]
class NewRoutine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $focus = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $exercises = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $reps = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $series = null;

    #[ORM\ManyToOne(inversedBy: 'userRoutine')]
    private ?User $usersRoutine = null;

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

    public function getFocus(): ?string
    {
        return $this->focus;
    }

    public function setFocus(?string $focus): static
    {
        $this->focus = $focus;

        return $this;
    }

    public function getExercises(): ?string
    {
        return $this->exercises;
    }

    public function setExercises(?string $exercises): static
    {
        $this->exercises = $exercises;

        return $this;
    }

    public function getReps(): ?string
    {
        return $this->reps;
    }

    public function setReps(?string $reps): static
    {
        $this->reps = $reps;

        return $this;
    }

    public function getSeries(): ?string
    {
        return $this->series;
    }

    public function setSeries(?string $series): static
    {
        $this->series = $series;

        return $this;
    }

    public function getUsersRoutine(): ?User
    {
        return $this->usersRoutine;
    }

    public function setUsersRoutine(?User $usersRoutine): static
    {
        $this->usersRoutine = $usersRoutine;

        return $this;
    }
}
