<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\AnimalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnimalRepository::class)]
#[ApiResource]
class Animal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['like:read'])]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['like:read'])]
    private ?\DateTimeInterface $birthday = null;

    #[ORM\Column(length: 255)]
    #[Groups(['like:read'])]
    private ?string $birthLocation = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['like:read'])]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    #[Groups(['like:read'])]
    private ?string $picture = null;

    #[ORM\Column]
    private ?bool $isSterilize = null;

    #[ORM\Column(length: 255)]
    private ?string $disease = null;

    #[ORM\OneToMany(mappedBy: 'animal_id', targetEntity: Like::class, orphanRemoval: true)]
    private Collection $likes;

    #[ORM\ManyToOne(inversedBy: 'animals')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Species $species_id = null;

    #[ORM\ManyToMany(targetEntity: Behaviour::class, mappedBy: 'animal_id')]
    private Collection $behaviours;

    public function __construct()
    {
        $this->likes = new ArrayCollection();
        $this->behaviours = new ArrayCollection();
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

    public function getBirthday()
    {
        return $this->birthday;
    }

    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getBirthLocation(): ?string
    {
        return $this->birthLocation;
    }

    public function setBirthLocation(string $birthLocation): self
    {
        $this->birthLocation = $birthLocation;

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

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function isIsSterilize(): ?bool
    {
        return $this->isSterilize;
    }

    public function setIsSterilize(bool $isSterilize): self
    {
        $this->isSterilize = $isSterilize;

        return $this;
    }

    public function getDisease(): ?string
    {
        return $this->disease;
    }

    public function setDisease(string $disease): self
    {
        $this->disease = $disease;

        return $this;
    }

    /**
     * @return Collection<int, Like>
     */
    public function getLikes(): Collection
    {
        return $this->likes;
    }

    public function addLike(Like $like): self
    {
        if (!$this->likes->contains($like)) {
            $this->likes->add($like);
            $like->setAnimalId($this);
        }

        return $this;
    }

    public function removeLike(Like $like): self
    {
        if ($this->likes->removeElement($like)) {
            // set the owning side to null (unless already changed)
            if ($like->getAnimalId() === $this) {
                $like->setAnimalId(null);
            }
        }

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

    /**
     * @return Collection<int, Behaviour>
     */
    public function getBehaviours(): Collection
    {
        return $this->behaviours;
    }

    public function addBehaviour(Behaviour $behaviour): self
    {
        if (!$this->behaviours->contains($behaviour)) {
            $this->behaviours->add($behaviour);
            $behaviour->addAnimalId($this);
        }

        return $this;
    }

    public function removeBehaviour(Behaviour $behaviour): self
    {
        if ($this->behaviours->removeElement($behaviour)) {
            $behaviour->removeAnimalId($this);
        }

        return $this;
    }
}
