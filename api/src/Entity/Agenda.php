<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\AgendaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AgendaRepository::class)]
#[ApiResource]
class Agenda
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'agendas')]
    private ?SPA $spa_id = null;

    #[ORM\ManyToOne(inversedBy: 'agendas')]
    private ?User $user_id = null;

    #[ORM\ManyToOne(inversedBy: 'agendas')]
    private ?User $spa_user_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

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
