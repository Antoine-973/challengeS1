<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\DonationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DonationRepository::class)]
#[ApiResource]
class Donation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $amount = null;

    #[ORM\Column]
    private ?int $orderId = null;

    #[ORM\Column]
    private ?bool $isSubscriber = null;

    #[ORM\ManyToOne(inversedBy: 'donations')]
    private ?User $user_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getOrderId(): ?int
    {
        return $this->orderId;
    }

    public function setOrderId(int $orderId): self
    {
        $this->orderId = $orderId;

        return $this;
    }

    public function isIsSubscriber(): ?bool
    {
        return $this->isSubscriber;
    }

    public function setIsSubscriber(bool $isSubscriber): self
    {
        $this->isSubscriber = $isSubscriber;

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
}
