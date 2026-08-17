<?php

namespace App\Entity;

use App\Repository\LinksRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LinksRepository::class)]
class Links
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 2048)]
    private ?string $originalUrl = null;

    #[ORM\Column(length: 20)]
    private ?string $shortCode = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $expiresAt = null;

    #[ORM\ManyToOne(inversedBy: 'links')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $owner = null;

    /**
     * @var Collection<int, Clicks>
     */
    #[ORM\OneToMany(targetEntity: Clicks::class, mappedBy: 'link', orphanRemoval: true)]
    private Collection $clicks;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->clicks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOriginalUrl(): ?string
    {
        return $this->originalUrl;
    }

    public function setOriginalUrl(string $originalUrl): static
    {
        $this->originalUrl = $originalUrl;

        return $this;
    }

    public function getShortCode(): ?string
    {
        return $this->shortCode;
    }

    public function setShortCode(string $shortCode): static
    {
        $this->shortCode = $shortCode;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getExpiresAt(): ?\DateTimeImmutable
    {
        return $this->expiresAt;
    }

    public function setExpiresAt(?\DateTimeImmutable $expiresAt): static
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): static
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * @return Collection<int, Clicks>
     */
    public function getClicks(): Collection
    {
        return $this->clicks;
    }

    public function addClick(Clicks $click): static
    {
        if (!$this->clicks->contains($click)) {
            $this->clicks->add($click);
            $click->setLink($this);
        }

        return $this;
    }

    public function removeClick(Clicks $click): static
    {
        if ($this->clicks->removeElement($click)) {
            // set the owning side to null (unless already changed)
            if ($click->getLink() === $this) {
                $click->setLink(null);
            }
        }

        return $this;
    }
}
