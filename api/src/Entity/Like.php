<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\LikeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LikeRepository::class)]
#[ORM\Table(name: '`like`')]
#[ApiResource]
class Like
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $isPending = true;

    #[ORM\Column]
    private ?bool $isValidate = false;

    #[ORM\ManyToOne(inversedBy: 'likes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user_id = null;

    #[ORM\ManyToOne(inversedBy: 'likes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Animal $animal_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isIsPending(): ?bool
    {
        return $this->isPending;
    }

    public function setIsPending(bool $isPending): self
    {
        $this->isPending = $isPending;

        return $this;
    }

    public function isIsValidate(): ?bool
    {
        return $this->isValidate;
    }

    public function setIsValidate(bool $isValidate): self
    {
        $this->isValidate = $isValidate;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getAnimalId(): ?Animal
    {
        return $this->animal_id;
    }

    public function setAnimalId(?Animal $animal_id): self
    {
        $this->animal_id = $animal_id;

        return $this;
    }
}
