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
    private ?Spa $spa = null;

    #[ORM\ManyToOne(inversedBy: 'agendas')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'agendas')]
    private ?User $spaUser = null;

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

    public function getSpa(): ?Spa
    {
        return $this->spa;
    }

    public function setSpa(?Spa $spa): self
    {
        $this->spa = $spa;

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
}
