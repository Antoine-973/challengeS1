<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ReviewRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReviewRepository::class)]
#[ApiResource]
class Review
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $rate = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'reviews')]
    private ?SPA $spa_id = null;

    #[ORM\ManyToOne(inversedBy: 'reviews')]
    private ?User $user_id = null;

    #[ORM\ManyToOne(inversedBy: 'reviews')]
    private ?User $spa_user_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRate(): ?int
    {
        return $this->rate;
    }

    public function setRate(int $rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSpaId(): ?SPA
    {
        return $this->spa_id;
    }

    public function setSpaId(?SPA $spa_id): self
    {
        $this->spa_id = $spa_id;

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

    public function getSpaUserId(): ?User
    {
        return $this->spa_user_id;
    }

    public function setSpaUserId(?User $spa_user_id): self
    {
        $this->spa_user_id = $spa_user_id;

        return $this;
    }
}
