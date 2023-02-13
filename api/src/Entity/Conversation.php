<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Link;
use App\Repository\ConversationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ConversationRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['read:conversation']],
    denormalizationContext: ['groups' => ['write:conversation']],
)]
#[ApiResource(
    uriTemplate: '/users/{id}/conversations',
    operations: [new GetCollection()],
    uriVariables: [
        'id' => new Link(
            fromClass: User::class,
            fromProperty: 'conversations',
        )
    ],
    normalizationContext: ['groups' => ['read:conversation']]
)]

class Conversation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read:conversation'])]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'conversation', targetEntity: Message::class)]
    #[Groups('read:conversation')]
    private Collection $messages;

    #[ORM\ManyToOne(inversedBy: 'conversations')]
    #[Groups(['write:conversation', 'read:conversation'])]
    private ?User $adopter = null;

    #[ORM\Column]
    #[Groups([ 'read:conversation'])]
    private ?bool $isPending = false;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[Groups(['write:conversation', 'read:conversation'])]
    private ?Like $adoptionRequest = null;

    public function __construct()
    {
        $this->messages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Message>
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages->add($message);
            $message->setConversation($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getConversation() === $this) {
                $message->setConversation(null);
            }
        }

        return $this;
    }

    public function getAdopter(): ?User
    {
        return $this->adopter;
    }

    public function setAdopter(?User $adopter): self
    {
        $this->adopter = $adopter;

        return $this;
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

    public function getAdoptionRequest(): ?Like
    {
        return $this->adoptionRequest;
    }

    public function setAdoptionRequest(?Like $adoptionRequest): self
    {
        $this->adoptionRequest = $adoptionRequest;

        return $this;
    }
}
