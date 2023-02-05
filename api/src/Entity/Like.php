<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\LikeRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Controller\LikeUserCustomController;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: LikeRepository::class)]
#[ORM\Table(name: '`like`')]
#[ApiResource(
    normalizationContext: ['groups' => ['like:read']],
    denormalizationContext: ['groups' => ['like:create', 'like:update']],
    operations: [
        new GetCollection(),
        new Get(),
        new Post(),
        new Patch(
            uriTemplate: '/likes/{id}',
            controller: LikeUserCustomController::class,
            normalizationContext: ['groups' => 'like:read'],
            denormalizationContext: ['groups' => 'like:update'],
            name: 'sendLikeUser'
        ),
        new Put(),
        new Delete(),
    ]
)]
class Like
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['like:read', 'like:update'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['like:read', 'like:update'])]
    private ?bool $isPending = true;

    #[ORM\Column]
    #[Groups(['like:read', 'like:update'])]
    private ?bool $isValidate = false;

    #[ORM\ManyToOne(inversedBy: 'likes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'likes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Animal $animal = null;

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
    #[Groups(['like:read'])]
    public function getUserId(): ?User
    {
        return $this->user;
    }

    public function setUserId(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
    #[Groups(['like:read'])]
    public function getAnimalId(): ?Animal
    {
        return $this->animal;
    }

    public function setAnimalId(?Animal $animal): self
    {
        $this->animal = $animal;

        return $this;
    }
}
