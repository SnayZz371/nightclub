<?php

namespace App\Entity;

use App\Repository\ArtistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArtistRepository::class)]
class Artist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $nom = null;

    #[ORM\Column(length: 10)]
    private ?string $prenom = null;

    #[ORM\Column]
    private ?int $telephone = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    /**
     * @var Collection<int, Soiree>
     */
    #[ORM\ManyToMany(targetEntity: Soiree::class, mappedBy: 'soiree_artist')]
    private Collection $artist_soiree;

    public function __construct()
    {
        $this->artist_soiree = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): static
    {
        $this->telephone = $telephone;

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

    /**
     * @return Collection<int, Soiree>
     */
    public function getArtistSoiree(): Collection
    {
        return $this->artist_soiree;
    }

    public function addArtistSoiree(Soiree $artistSoiree): static
    {
        if (!$this->artist_soiree->contains($artistSoiree)) {
            $this->artist_soiree->add($artistSoiree);
            $artistSoiree->addSoireeArtist($this);
        }

        return $this;
    }

    public function removeArtistSoiree(Soiree $artistSoiree): static
    {
        if ($this->artist_soiree->removeElement($artistSoiree)) {
            $artistSoiree->removeSoireeArtist($this);
        }

        return $this;
    }
}
