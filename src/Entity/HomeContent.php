<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\HomeContentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HomeContentRepository::class)]
#[ApiResource]
class HomeContent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $section_name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSectionName(): ?string
    {
        return $this->section_name;
    }

    public function setSectionName(string $section_name): static
    {
        $this->section_name = $section_name;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }
}
