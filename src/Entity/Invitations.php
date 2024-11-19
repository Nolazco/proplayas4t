<?php

namespace App\Entity;

use App\Enum\InvitationRoles;
use App\Enum\InvitationStatus;
use App\Repository\InvitationsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InvitationsRepository::class)]
class Invitations
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(enumType: InvitationRoles::class)]
    private ?InvitationRoles $role_type = null;

    #[ORM\ManyToOne(inversedBy: 'invitations')]
    private ?Node $node = null;

    #[ORM\Column(length: 10)]
    private ?string $reserved_code = null;

    #[ORM\Column(enumType: InvitationStatus::class)]
    private ?InvitationStatus $status = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $sent_date = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $accepted_date = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $expired_date = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getRoleType(): ?InvitationRoles
    {
        return $this->role_type;
    }

    public function setRoleType(InvitationRoles $role_type): static
    {
        $this->role_type = $role_type;

        return $this;
    }

    public function getNode(): ?Node
    {
        return $this->node;
    }

    public function setNode(?Node $node): static
    {
        $this->node = $node;

        return $this;
    }

    public function getReservedCode(): ?string
    {
        return $this->reserved_code;
    }

    public function setReservedCode(string $reserved_code): static
    {
        $this->reserved_code = $reserved_code;

        return $this;
    }

    public function getStatus(): ?InvitationStatus
    {
        return $this->status;
    }

    public function setStatus(InvitationStatus $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getSentDate(): ?\DateTimeInterface
    {
        return $this->sent_date;
    }

    public function setSentDate(\DateTimeInterface $sent_date): static
    {
        $this->sent_date = $sent_date;

        return $this;
    }

    public function getAcceptedDate(): ?\DateTimeInterface
    {
        return $this->accepted_date;
    }

    public function setAcceptedDate(\DateTimeInterface $accepted_date): static
    {
        $this->accepted_date = $accepted_date;

        return $this;
    }

    public function getExpiredDate(): ?\DateTimeInterface
    {
        return $this->expired_date;
    }

    public function setExpiredDate(\DateTimeInterface $expired_date): static
    {
        $this->expired_date = $expired_date;

        return $this;
    }
}
