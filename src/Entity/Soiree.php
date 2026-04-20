<?php

namespace App\Entity;

use App\Repository\SoireeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: SoireeRepository::class)]
class Soiree
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(
        min: 10,
        max: 65,
        minMessage: 'Ce titre est trop court',
        maxMessage: 'Ce titre est trop long',
    )]
    #[Assert\NotBlank(message: 'Le titre ne peut pas être vide.')]
    private ?string $titre = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $dateSoiree = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $dateCreation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $statut = null;

    /**
     * @var Collection<int, Artist>
     */
    #[ORM\ManyToMany(targetEntity: Artist::class, inversedBy: 'artist_soiree')]
    private Collection $soiree_artist;

    public function __construct()
    {
        $this->soiree_artist = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDateSoiree(): ?\DateTimeImmutable
    {
        return $this->dateSoiree;
    }

    public function setDateSoiree(\DateTimeImmutable $dateSoiree): static
    {
        $this->dateSoiree = $dateSoiree;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeImmutable
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeImmutable $dateCreation): static
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(?string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * @return Collection<int, Artist>
     */
    public function getSoireeArtist(): Collection
    {
        return $this->soiree_artist;
    }

    public function addSoireeArtist(Artist $soireeArtist): static
    {
        if (!$this->soiree_artist->contains($soireeArtist)) {
            $this->soiree_artist->add($soireeArtist);
        }

        return $this;
    }

    public function removeSoireeArtist(Artist $soireeArtist): static
    {
        $this->soiree_artist->removeElement($soireeArtist);

        return $this;
    }
    
    
}
