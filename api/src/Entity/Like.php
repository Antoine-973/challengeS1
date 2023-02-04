<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\LikeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Controller\ReviewController;
use App\Controller\LikesController;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Delete;

#[ORM\Entity(repositoryClass: LikeRepository::class)]
#[ORM\Table(name: '`like`')]
#[ApiResource(
    normalizationContext: ['groups' => ['like:read']],
    denormalizationContext: ['groups' => ['like:create', 'like:update']],
    operations: [
        new Get(
            uriTemplate: '/likes/getAcceptedLikes',
            // denormalizationContext: ['groups' => 'user:confirm:account:patch'],
            controller: ReviewController::class,
            read: false,
            name: 'getAcceptedLikes'
        ),
        new Post(),
        new Delete(),
        new Patch(),
        new Put(),
        new Get(),
        new Get(
            uriTemplate: '/likes',
            controller: LikesController::class,
            read: false,
            name: 'getLikes'
        )
    ]

)]
class Like
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['like:read'])]
    private ?bool $isPending = true;

    #[ORM\Column]
    #[Groups(['like:read'])]
    private ?bool $isValidate = false;

    #[ORM\ManyToOne(inversedBy: 'likes')]
    #[Groups(['like:read'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'likes')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['like:read'])]
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
