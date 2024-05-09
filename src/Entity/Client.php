<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $email = null;

    #[ORM\Column]
    private ?int $phone = null;

    #[ORM\OneToOne(mappedBy: 'client', cascade: ['persist', 'remove'])]
    private ?Reservation $reservation = null;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
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

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(int $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getReservation(): ?Reservation
    {
        return $this->reservation;
    }

    public function setReservation(?Reservation $reservation): static
    {
        // unset the owning side of the relation if necessary
        if ($reservation === null && $this->reservation !== null) {
            $this->reservation->setClient(null);
        }

        // set the owning side of the relation if necessary
        if ($reservation !== null && $reservation->getClient() !== $this) {
            $reservation->setClient($this);
        }

        $this->reservation = $reservation;

        return $this;
    }
}
