<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\BreedRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BreedRepository::class)]
#[ApiResource]
class Breed
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'breeds')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Species $species_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getSpeciesId(): ?Species
    {
        return $this->species_id;
    }

    public function setSpeciesId(?Species $species_id): self
    {
        $this->species_id = $species_id;

        return $this;
    }
}
