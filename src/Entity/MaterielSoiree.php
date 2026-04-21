<?php

namespace App\Entity;

use App\Repository\MaterielSoireeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MaterielSoireeRepository::class)]
class MaterielSoiree
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $dateReservationDebut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $dateReservationFin = null;

    #[ORM\ManyToOne(inversedBy: 'materielSoirees')]
    private ?Materiel $materiel = null;

    #[ORM\ManyToOne(inversedBy: 'materielSoirees')]
    private ?Soiree $soiree = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateReservationDebut(): ?\DateTime
    {
        return $this->dateReservationDebut;
    }

    public function setDateReservationDebut(?\DateTime $dateReservationDebut): static
    {
        $this->dateReservationDebut = $dateReservationDebut;

        return $this;
    }

    public function getDateReservationFin(): ?\DateTime
    {
        return $this->dateReservationFin;
    }

    public function setDateReservationFin(?\DateTime $dateReservationFin): static
    {
        $this->dateReservationFin = $dateReservationFin;

        return $this;
    }

    public function getMateriel(): ?Materiel
    {
        return $this->materiel;
    }

    public function setMateriel(?Materiel $materiel): static
    {
        $this->materiel = $materiel;

        return $this;
    }

    public function getSoiree(): ?Soiree
    {
        return $this->soiree;
    }

    public function setSoiree(?Soiree $soiree): static
    {
        $this->soiree = $soiree;

        return $this;
    }
}
