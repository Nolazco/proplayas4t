<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Link;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\ChapterRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Query\Expr\From;

#[ORM\Entity(repositoryClass: ChapterRepository::class)]
#[ApiResource(operations: [new Get(), new Post(), new Delete(), new Put(), new Patch()])]
#[ApiResource(
    uriTemplate: '/web_series/{id}/chapters',
    uriVariables: [
        'id' => new Link(
            fromClass: WebSerie::class,
            fromProperty: 'chapters'
        )
    ],
    operations: [new GetCollection()]
)]
class Chapter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Media $media = null;

    #[ORM\Column]
    private ?int $number = null;

    #[ORM\ManyToOne(inversedBy: 'chapters')]
    #[ORM\JoinColumn(nullable: false)]
    private ?WebSerie $webSerie = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getMedia(): ?Media
    {
        return $this->media;
    }

    public function setMedia(?Media $media): static
    {
        $this->media = $media;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): static
    {
        $this->number = $number;

        return $this;
    }

    public function getWebSerie(): ?WebSerie
    {
        return $this->webSerie;
    }

    public function setWebSerie(?WebSerie $webSerie): static
    {
        $this->webSerie = $webSerie;

        return $this;
    }
}
