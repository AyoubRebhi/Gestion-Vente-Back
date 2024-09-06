<?php

namespace App\Entity;

use App\Repository\CaisseRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: CaisseRepository::class)]
class Caisse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: PointDeVente::class, inversedBy: 'caisses')]
    private ?PointDeVente $pointDeVente = null;

    /**
     * @var Collection<int, Utilisateur>
     */
    #[ORM\OneToMany(mappedBy: 'caisse', targetEntity: Utilisateur::class)]
    private Collection $utilisateurs;

    public function __construct()
    {
        $this->utilisateurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPointDeVente(): ?PointDeVente
    {
        return $this->pointDeVente;
    }

    public function setPointDeVente(?PointDeVente $pointDeVente): static
    {
        $this->pointDeVente = $pointDeVente;
        return $this;
    }

    /**
     * @return Collection<int, Utilisateur>
     */
    public function getUtilisateurs(): Collection
    {
        return $this->utilisateurs;
    }

    public function addUtilisateur(Utilisateur $utilisateur): static
    {
        if (!$this->utilisateurs->contains($utilisateur)) {
            $this->utilisateurs->add($utilisateur);
            $utilisateur->setCaisse($this);
        }

        return $this;
    }

    public function removeUtilisateur(Utilisateur $utilisateur): static
    {
        if ($this->utilisateurs->removeElement($utilisateur)) {
            // set the owning side to null (unless already changed)
            if ($utilisateur->getCaisse() === $this) {
                $utilisateur->setCaisse(null);
            }
        }

        return $this;
    }

    /**
     * @return ArrayCollection<int, Utilisateur>|null
     */
    public function getIdUtilisateur(): ?ArrayCollection
    {
        return $this->utilisateurs instanceof ArrayCollection ? $this->utilisateurs : null;
    }

    /**
     * @param ArrayCollection<int, Utilisateur> $utilisateurs
     * @return static
     */
    public function setIdUtilisateur(ArrayCollection $utilisateurs): static
    {
        $this->utilisateurs = $utilisateurs;

        return $this;
    }
}
