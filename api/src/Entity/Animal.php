<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Controller\AnimalController;
use App\Repository\AnimalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: AnimalRepository::class)]
#[ApiResource(
    operations: [
    new GetCollection(),
    new GetCollection(
        uriTemplate: '/animals/not_liked',
        controller: AnimalController::class,
        paginationEnabled: false,
        normalizationContext: ['groups' => ['animal:read']],
        security: 'is_granted("ROLE_USER")',
        filters: [],
        read: false,
        name: 'not_liked_animals',
    ),
    new Get(),
        new Post(),
        new Patch(),
        new Delete(),
    ],
    normalizationContext: ['groups' => ['animal:read']],
    denormalizationContext: ['groups' => ['animal:create', 'animal:update']],
)]
class Animal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['like:read', 'animal:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['animal:read', 'like:read', 'animal:create', 'animal:update'])]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['animal:read', 'like:read', 'animal:create', 'animal:update'])]
    private ?\DateTimeInterface $birthday = null;

    #[ORM\Column(length: 255)]
    #[Groups(['animal:read', 'like:read', 'animal:create', 'animal:update'])]
    private ?string $birthLocation = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['like:read', 'animal:read'])]
    private ?string $description = null;

    #[ORM\Column]
    #[Groups(['animal:read'])]
    private ?bool $isSterilize = null;

    #[ORM\OneToMany(mappedBy: 'animal', targetEntity: Like::class, orphanRemoval: true)]
    #[Groups(['like:read'])]
    private Collection $likes;

    #[ORM\ManyToOne(inversedBy: 'animals')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['animal:read, like:read'])]
    private ?Species $species = null;

    #[ORM\Column(type: Types::SMALLINT)]
    #[Groups(['like:read', 'animal:read'])]
    private ?int $sex = null;

    #[ORM\ManyToMany(targetEntity: Breed::class, inversedBy: 'animals')]
    #[Groups(['like:read', 'animal:read'])]
    private Collection $breeds;

    #[ORM\ManyToOne(inversedBy: 'animals')]
    #[Groups(['like:read', 'animal:read'])]
    private ?Spa $spa = null;

    #[ORM\ManyToMany(targetEntity: Behaviour::class, inversedBy: 'animals')]
    #[Groups(['like:read', 'animal:read'])]
    private Collection $behaviours;

    #[ORM\OneToMany(mappedBy: 'animal', targetEntity: AnimalPicture::class, orphanRemoval: true)]
    #[Groups(['like:read','animal:read'])]
    private Collection $animalPictures;

    public function __construct()
    {
        $this->breeds = new ArrayCollection();
        $this->behaviours = new ArrayCollection();
        $this->animalPictures = new ArrayCollection();
        $this->likes = new ArrayCollection();
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

    public function isIsSterilize(): ?bool
    {
        return $this->isSterilize;
    }

    public function setIsSterilize(bool $isSterilize): self
    {
        $this->isSterilize = $isSterilize;

        return $this;
    }

    public function getSpecies(): ?Species
    {
        return $this->species;
    }

    public function setSpecies(?Species $species): self
    {
        $this->species = $species;

        return $this;
    }

    public function getSex(): ?int
    {
        return $this->sex;
    }

    public function setSex(int $sex): self
    {
        $this->sex = $sex;

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
        }

        return $this;
    }

    public function removeBreed(Breed $breed): self
    {
        $this->breeds->removeElement($breed);

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
        }

        return $this;
    }

    public function removeBehaviour(Behaviour $behaviour): self
    {
        $this->behaviours->removeElement($behaviour);

        return $this;
    }

    /**
     * @return Collection<int, AnimalPicture>
     */
    public function getAnimalPictures(): Collection
    {
        return $this->animalPictures;
    }

    public function addAnimalPicture(AnimalPicture $animalPicture): self
    {
        if (!$this->animalPictures->contains($animalPicture)) {
            $this->animalPictures->add($animalPicture);
            $animalPicture->setAnimal($this);
        }

        return $this;
    }

    public function removeAnimalPicture(AnimalPicture $animalPicture): self
    {
        if ($this->animalPictures->removeElement($animalPicture)) {
            // set the owning side to null (unless already changed)
            if ($animalPicture->getAnimal() === $this) {
                $animalPicture->setAnimal(null);
            }
        }

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
            $like->setAnimal($this);
        }

        return $this;
    }

    public function removeLike(Like $like): self
    {
        if ($this->likes->removeElement($like)) {
            // set the owning side to null (unless already changed)
            if ($like->getAnimal() === $this) {
                $like->setAnimal(null);
            }
        }

        return $this;
    }
}
