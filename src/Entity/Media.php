<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\MediaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MediaRepository::class)]
#[ApiResource]
class Media
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $size = null;

    #[ORM\Column(length: 255)]
    private ?string $path = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $timestamp = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'media')]
    private Collection $uploader;

    #[ORM\Column(enumType: MediaTypes::class)]
    private ?MediaTypes $type = null;

    public function __construct()
    {
        $this->uploader = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSize(): ?float
    {
        return $this->size;
    }

    public function setSize(float $size): static
    {
        $this->size = $size;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): static
    {
        $this->path = $path;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getTimestamp(): ?\DateTimeInterface
    {
        return $this->timestamp;
    }

    public function setTimestamp(\DateTimeInterface $timestamp): static
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUploader(): Collection
    {
        return $this->uploader;
    }

    public function addUploader(User $uploader): static
    {
        if (!$this->uploader->contains($uploader)) {
            $this->uploader->add($uploader);
            $uploader->setMedia($this);
        }

        return $this;
    }

    public function removeUploader(User $uploader): static
    {
        if ($this->uploader->removeElement($uploader)) {
            // set the owning side to null (unless already changed)
            if ($uploader->getMedia() === $this) {
                $uploader->setMedia(null);
            }
        }

        return $this;
    }

    public function getType(): ?MediaTypes
    {
        return $this->type;
    }

    public function setType(MediaTypes $type): static
    {
        $this->type = $type;

        return $this;
    }
}

enum MediaTypes: string
{
    case BOOK = "book";
    case VIDEO = "video";
    case IMAGE = "image";
    case DEFAUL = "default";
}