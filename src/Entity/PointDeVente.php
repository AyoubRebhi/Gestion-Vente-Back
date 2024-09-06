<?php

namespace App\Entity;

use App\Repository\PointDeVenteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PointDeVenteRepository::class)]
class PointDeVente
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(type: 'integer')]
    private ?int $nbCaisse = null;

    #[ORM\Column(type: 'integer')]
    private ?int $nbEmploye = null;

    #[ORM\Column(type: 'datetime_immutable')]
    private ?\DateTimeImmutable $cree_le = null;

    #[ORM\Column(length: 50)]
    private ?string $jour_de_travail = null;

    /**
     * @var Collection<int, Utilisateur>
     */
    #[ORM\OneToMany(mappedBy: 'pointDeVente', targetEntity: Utilisateur::class)]
    private Collection $utilisateurs;

    /**
     * @var Collection<int, Caisse>
     */
    #[ORM\OneToMany(mappedBy: 'pointDeVente', targetEntity: Caisse::class)]
    private Collection $caisses;

    #[ORM\Column(length: 255)]
    private ?string $horaireOuverture = null;

    #[ORM\Column(length: 255)]
    private ?string $horaireFermeture = null;

    public function __construct()
    {
        $this->utilisateurs = new ArrayCollection();
        $this->caisses = new ArrayCollection();
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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;
        return $this;
    }

    public function getNbCaisse(): ?int
    {
        return $this->nbCaisse;
    }

    public function setNbCaisse(int $nbCaisse): static
    {
        $this->nbCaisse = $nbCaisse;
        return $this;
    }

    public function getNbEmploye(): ?int
    {
        return $this->nbEmploye;
    }

    public function setNbEmploye(int $nbEmploye): static
    {
        $this->nbEmploye = $nbEmploye;
        return $this;
    }

    public function getCree_le(): ?\DateTimeImmutable
    {
        return $this->cree_le;
    }

    public function setCree_le(\DateTimeImmutable $cree_le): static
    {
        $this->cree_le = $cree_le;
        return $this;
    }

    public function getJourDeTravail(): ?string
    {
        return $this->jour_de_travail;
    }

    public function setJourDeTravail(string $jour_de_travail): static
    {
        $this->jour_de_travail = $jour_de_travail;
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
            $utilisateur->setPointDeVente($this);
        }

        return $this;
    }

    public function removeUtilisateur(Utilisateur $utilisateur): static
    {
        if ($this->utilisateurs->removeElement($utilisateur)) {
            // set the owning side to null (unless already changed)
            if ($utilisateur->getPointDeVente() === $this) {
                $utilisateur->setPointDeVente(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Caisse>
     */
    public function getCaisses(): Collection
    {
        return $this->caisses;
    }

    public function addCaisse(Caisse $caisse): static
    {
        if (!$this->caisses->contains($caisse)) {
            $this->caisses->add($caisse);
            $caisse->setPointDeVente($this);
        }

        return $this;
    }

    public function removeCaisse(Caisse $caisse): static
    {
        if ($this->caisses->removeElement($caisse)) {
            // set the owning side to null (unless already changed)
            if ($caisse->getPointDeVente() === $this) {
                $caisse->setPointDeVente(null);
            }
        }

        return $this;
    }

    public function getHoraireOuverture(): ?string
    {
        return $this->horaireOuverture;
    }

    public function setHoraireOuverture(string $horaireOuverture): static
    {
        $this->horaireOuverture = $horaireOuverture;

        return $this;
    }

    public function getHoraireFermeture(): ?string
    {
        return $this->horaireFermeture;
    }

    public function setHoraireFermeture(string $horaireFermeture): static
    {
        $this->horaireFermeture = $horaireFermeture;

        return $this;
    }
}
