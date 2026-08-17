<?php

namespace App\Entity;

use App\Repository\ClicksRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClicksRepository::class)]
class Clicks
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'clicks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Links $link = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $clickedAt = null;

    #[ORM\Column(length: 512, nullable: true)]
    private ?string $userAgent = null;

    public function __construct()
    {
        $this->clickedAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLink(): ?Links
    {
        return $this->link;
    }

    public function setLink(?Links $link): static
    {
        $this->link = $link;

        return $this;
    }

    public function getClickedAt(): ?\DateTimeImmutable
    {
        return $this->clickedAt;
    }

    public function setClickedAt(\DateTimeImmutable $clickedAt): static
    {
        $this->clickedAt = $clickedAt;

        return $this;
    }

    public function getUserAgent(): ?string
    {
        return $this->userAgent;
    }

    public function setUserAgent(?string $userAgent): static
    {
        $this->userAgent = $userAgent;

        return $this;
    }
}
