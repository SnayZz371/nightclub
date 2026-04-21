<?php

namespace App\Entity;

use App\Repository\ThemeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ThemeRepository::class)]
class Theme
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    /**
     * @var Collection<int, Soiree>
     */
    #[ORM\OneToMany(targetEntity: Soiree::class, mappedBy: 'themeSoiree')]
    private Collection $soireeTheme;

    public function __construct()
    {
        $this->soireeTheme = new ArrayCollection();
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

    /**
     * @return Collection<int, Soiree>
     */
    public function getSoireeTheme(): Collection
    {
        return $this->soireeTheme;
    }

    public function addSoireeTheme(Soiree $soireeTheme): static
    {
        if (!$this->soireeTheme->contains($soireeTheme)) {
            $this->soireeTheme->add($soireeTheme);
            $soireeTheme->setThemeSoiree($this);
        }

        return $this;
    }

    public function removeSoireeTheme(Soiree $soireeTheme): static
    {
        if ($this->soireeTheme->removeElement($soireeTheme)) {
            // set the owning side to null (unless already changed)
            if ($soireeTheme->getThemeSoiree() === $this) {
                $soireeTheme->setThemeSoiree(null);
            }
        }

        return $this;
    }
}
