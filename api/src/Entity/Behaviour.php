<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\BehaviourRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BehaviourRepository::class)]
#[ApiResource]
class Behaviour
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\ManyToMany(targetEntity: Animal::class, inversedBy: 'behaviours')]
    private Collection $animal_id;

    public function __construct()
    {
        $this->animal_id = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Animal>
     */
    public function getAnimalId(): Collection
    {
        return $this->animal_id;
    }

    public function addAnimalId(Animal $animalId): self
    {
        if (!$this->animal_id->contains($animalId)) {
            $this->animal_id->add($animalId);
        }

        return $this;
    }

    public function removeAnimalId(Animal $animalId): self
    {
        $this->animal_id->removeElement($animalId);

        return $this;
    }
}
