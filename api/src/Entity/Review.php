<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ReviewRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ReviewRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['review:read']]
)]

class Review
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['review:read'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['review:read'])]
    private ?int $rate = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['review:read'])]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'reviews')]
    #[Groups(['review:read'])]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'reviews')]
    #[Groups(['review:read'])]
    private ?User $spaUser = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['review:read'])]
    private ?bool $isValidate = false;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getSpaUser(): ?User
    {
        return $this->spaUser;
    }

    public function setSpaUser(?User $spaUser): self
    {
        $this->spaUser = $spaUser;

        return $this;
    }

    public function isIsValidate(): ?bool
    {
        return $this->isValidate;
    }

    public function setIsValidate(?bool $isValidate): self
    {
        $this->isValidate = $isValidate;

        return $this;
    }
}
