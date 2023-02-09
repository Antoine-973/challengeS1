<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SpeciesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: SpeciesRepository::class)]
#[ApiResource
(
    normalizationContext: ['groups' => ['species:read']],
    denormalizationContext: ['groups' => ['species:create', 'species:update']],
)]
class Species
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['species:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['species:read','animal:read'])]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['species:read','animal:read'])]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'species', targetEntity: Animal::class, orphanRemoval: true)]
    private Collection $animals;

    #[Groups(['species:read'])]
    #[ORM\OneToMany(mappedBy: 'species', targetEntity: Breed::class, orphanRemoval: true)]
    private Collection $breeds;

    public function __construct()
    {
        $this->animals = new ArrayCollection();
        $this->breeds = new ArrayCollection();
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
    public function getAnimals(): Collection
    {
        return $this->animals;
    }

    public function addAnimal(Animal $animal): self
    {
        if (!$this->animals->contains($animal)) {
            $this->animals->add($animal);
            $animal->setSpeciesId($this);
        }

        return $this;
    }

    public function removeAnimal(Animal $animal): self
    {
        if ($this->animals->removeElement($animal)) {
            // set the owning side to null (unless already changed)
            if ($animal->getSpeciesId() === $this) {
                $animal->setSpeciesId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Breed>
     */
    public function getBreeds(): Collection
    {
        return $this->breeds;
    }

    public function addBreed(Breed $breed): self
    {
        if (!$this->breeds->contains($breed)) {
            $this->breeds->add($breed);
            $breed->setSpecies($this);
        }

        return $this;
    }

    public function removeBreed(Breed $breed): self
    {
        if ($this->breeds->removeElement($breed)) {
            // set the owning side to null (unless already changed)
            if ($breed->getSpecies() === $this) {
                $breed->setSpecies(null);
            }
        }

        return $this;
    }
}
