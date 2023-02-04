<?php
# api/src/Entity/User.php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Controller\ConfirmAccountController;
use App\Controller\RegisterCustomController;
use cebe\openapi\spec\Parameter;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use App\State\UserPasswordHasher;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


#[ApiResource(
    operations: [
        new GetCollection(),
        new Post(processor: UserPasswordHasher::class),
        new Post(
            uriTemplate: '/api/register',
            controller: RegisterCustomController::class,
            normalizationContext: ['groups' => 'user:register:read'],
            denormalizationContext: ['groups' => 'user:register:create'],
            name: 'registerUser',
            processor: UserPasswordHasher::class
        ),
        new Post(
            uriTemplate: '/api/confirm',
            controller: ConfirmAccountController::class,
            denormalizationContext: ['groups' => 'user:confirm:account:patch'],
            read: false,
            name: 'confirmAccount'
        ),
        new Get(),
        new Put(processor: UserPasswordHasher::class),
        new Patch(processor: UserPasswordHasher::class),
        new Delete(),
    ],
    normalizationContext: ['groups' => ['user:read']],
    denormalizationContext: ['groups' => ['user:create', 'user:update']],
)]
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[UniqueEntity('email')]
#[ApiFilter(SearchFilter::class, properties: ['email' => 'exact'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[Groups(['user:read', 'like:read', 'review:read'])]
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    #[ApiProperty(identifier: true)]
    private ?int $id = null;

    #[Assert\NotBlank]
    #[Assert\Email]
    #[Groups(['user:read', 'user:create', 'user:update','user:register:read','user:register:create'])]
    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[Assert\NotBlank(groups: ['user:create'])]
    #[Groups(['user:create', 'user:update', 'user:register:read','user:register:create'])]
    private ?string $plainPassword = null;

    #[Groups(['user:read'])]
    #[ORM\Column(type: 'json')]
    private array $roles = [];


    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['user:create', 'user:update', 'user:register:read','user:register:create','like:read', 'user:read', 'review:read'])]
    private ?string $firstname = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['user:create', 'user:update', 'user:register:read','user:register:create','like:read', 'user:read', 'review:read'])]
    private ?string $lastname = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['user:create','user:read', 'user:update', 'user:register:read','user:register:create'])]
    private ?string $city = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['user:create','user:read', 'user:update', 'user:register:read','user:register:create'])]
    private ?string $description = null;


    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['user:update', 'user:read'])]
    private ?string $picture = null;

    #[ORM\Column]
    #[Groups(['user:update','user:read'])]
    private ?bool $isSubscriber = false;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['user:confirm:create', 'user:confirm:read','user:confirm:account:patch'])]
    private ?string $confirmAccount = null;

    #[ORM\Column]
    #[Groups(['user:confirm:read'])]
    private ?bool $isVerified = false;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $resetPassword = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Like::class, orphanRemoval: true)]
    #[Groups(['user:read',  'user:update'])]
    private Collection $likes;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Donation::class)]
    #[Groups(['user:read',  'user:update'])]
    private Collection $donations;

    #[ORM\ManyToOne(inversedBy: 'users', targetEntity: Spa::class)]
    #[Groups(['user:read', 'user:update'])]
    private ?Spa $spa = null;

    #[Groups(['user:read'])]
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Agenda::class)]
    private Collection $agendas;

    #[Groups(['user:read'])]
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Review::class)]
    private Collection $reviews;

    #[ORM\OneToMany(mappedBy: 'users', targetEntity: ResetPassword::class)]
    private Collection $resetPasswords;

    public function __construct()
    {
        $this->likes = new ArrayCollection();
        $this->donations = new ArrayCollection();
        $this->agendas = new ArrayCollection();
        $this->reviews = new ArrayCollection();
        $this->resetPasswords = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(?string $painPassword): self
    {
        $this->plainPassword = $painPassword;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;

        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        $this->plainPassword = null;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

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

    public function isConfirmAccount(): ?bool
    {
        return $this->confirmAccount;
    }

    public function setConfirmAccount(String $confirmAccount): self
    {
        $this->confirmAccount = $confirmAccount;

        return $this;
    }

    public function getConfirmAccount() {
        return $this->confirmAccount ;
    }

    public function isIsVerified(): ?bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getResetPassword(): ?string
    {
        return $this->resetPassword;
    }

    public function setResetPassword(?string $resetPassword): self
    {
        $this->resetPassword = $resetPassword;

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
            $like->setUserId($this);
        }

        return $this;
    }

    public function removeLike(Like $like): self
    {
        if ($this->likes->removeElement($like)) {
            // set the owning side to null (unless already changed)
            if ($like->getUserId() === $this) {
                $like->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Donation>
     */
    public function getDonations(): Collection
    {
        return $this->donations;
    }

    public function addDonation(Donation $donation): self
    {
        if (!$this->donations->contains($donation)) {
            $this->donations->add($donation);
            $donation->setUserId($this);
        }

        return $this;
    }

    public function removeDonation(Donation $donation): self
    {
        if ($this->donations->removeElement($donation)) {
            // set the owning side to null (unless already changed)
            if ($donation->getUserId() === $this) {
                $donation->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Agenda>
     */
    public function getAgendas(): Collection
    {
        return $this->agendas;
    }

    public function addAgenda(Agenda $agenda): self
    {
        if (!$this->agendas->contains($agenda)) {
            $this->agendas->add($agenda);
            $agenda->setUserId($this);
        }

        return $this;
    }

    public function removeAgenda(Agenda $agenda): self
    {
        if ($this->agendas->removeElement($agenda)) {
            // set the owning side to null (unless already changed)
            if ($agenda->getUserId() === $this) {
                $agenda->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Review>
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(Review $review): self
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews->add($review);
            $review->setUserId($this);
        }

        return $this;
    }

    public function removeReview(Review $review): self
    {
        if ($this->reviews->removeElement($review)) {
            // set the owning side to null (unless already changed)
            if ($review->getUserId() === $this) {
                $review->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ResetPassword>
     */
    public function getResetPasswords(): Collection
    {
        return $this->resetPasswords;
    }

    public function addResetPassword(ResetPassword $resetPassword): self
    {
        if (!$this->resetPasswords->contains($resetPassword)) {
            $this->resetPasswords->add($resetPassword);
            $resetPassword->setUsers($this);
        }

        return $this;
    }

    public function removeResetPassword(ResetPassword $resetPassword): self
    {
        if ($this->resetPasswords->removeElement($resetPassword)) {
            // set the owning side to null (unless already changed)
            if ($resetPassword->getUsers() === $this) {
                $resetPassword->setUsers(null);
            }
        }

        return $this;
    }
}
