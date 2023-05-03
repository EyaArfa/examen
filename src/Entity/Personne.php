<?php

namespace App\Entity;

use App\Repository\PersonneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersonneRepository::class)]
class Personne
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_nais = null;

    #[ORM\Column(length: 255)]
    private ?string $cin = null;

    #[ORM\OneToMany(mappedBy: 'prop', targetEntity: Voiture::class)]
    private Collection $matricule;

    public function __construct()
    {
        $this->matricule = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDateNais(): ?\DateTimeInterface
    {
        return $this->date_nais;
    }

    public function setDateNais(\DateTimeInterface $date_nais): self
    {
        $this->date_nais = $date_nais;

        return $this;
    }

    public function getCin(): ?string
    {
        return $this->cin;
    }

    public function setCin(string $cin): self
    {
        $this->cin = $cin;

        return $this;
    }

    /**
     * @return Collection<int, Voiture>
     */
    public function getMatricule(): Collection
    {
        return $this->matricule;
    }

    public function addMatricule(Voiture $matricule): self
    {
        if (!$this->matricule->contains($matricule)) {
            $this->matricule->add($matricule);
            $matricule->setProp($this);
        }

        return $this;
    }

    public function removeMatricule(Voiture $matricule): self
    {
        if ($this->matricule->removeElement($matricule)) {
            // set the owning side to null (unless already changed)
            if ($matricule->getProp() === $this) {
                $matricule->setProp(null);
            }
        }

        return $this;
    }
    public function  __toString(): string
    {
        return $this->getCin();
    }
}
