<?php

namespace App\Entity;

use App\Repository\VenteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Article;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: VenteRepository::class)]
class Vente
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "id_vente")]
    private ?int $idVente = null;

    #[ORM\Column(length: 20)]
    #[Groups("vente:read")]
    private ?string $num_carte_fidalite = null;

    #[ORM\Column(type: 'integer')]
    #[Groups("vente:read")]
    private int $id_caisse = 0;

     /**
     * @var array<array{article: int, quantity: int, prixTTC: float, remise: float, totalTTC: float}>
     */
    #[ORM\Column(type: 'json')]
    #[Groups("vente:read")]
    private array $listeArticles = [];

    #[ORM\Column(type: 'float')]
    #[Groups("vente:read")]
    private float $remiseGlobale;

    #[ORM\Column(type: 'float')]
    #[Groups("vente:read")]
    private float $netApayer;

    #[ORM\Column(type: 'float')]
    #[Groups("vente:read")]
    private float $payer;

    #[ORM\Column(type: 'float')]
    #[Groups("vente:read")]
    private float $aRendre;

    #[ORM\Column(type: 'float')]
    #[Groups("vente:read")]
    private ?float $totalTTC = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups("vente:read")]
    private ?\DateTimeInterface $dateAchat = null;

    #[ORM\Column(type: 'string', length: 10, unique: true)]
    #[Groups("vente:read")]
    private string $BV;

    #[ORM\Column(type: 'float')]
    #[Groups("vente:read")]
    private float $acompte = 0.0;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    #[Groups("vente:read")]
    private ?\DateTimeInterface $dateLimite = null;

    /**
     * @var Collection<int, BonRetour>
     */
    #[ORM\OneToMany(mappedBy: 'vente', targetEntity: BonRetour::class)]
    private Collection $bonsRetour;

    public function __construct()
    {
        $this->BV = $this->generateUniqueBV();
        $this->dateAchat = new \DateTime();
        $this->bonsRetour = new ArrayCollection();
    }
    // Getters and setters for the new properties

    
    public function getAcompte(): float
    {
        return $this->acompte;
    }

    public function setAcompte(float $acompte): self
    {
        $this->acompte = $acompte;
        return $this;
    }

    public function getDateLimite(): ?\DateTimeInterface
    {
        return $this->dateLimite;
    }

    public function setDateLimite(?\DateTimeInterface $dateLimite): self
    {
        $this->dateLimite = $dateLimite;
        return $this;
    }

    
    /**
     * @return Collection<int, BonRetour>
     */
    public function getBonsRetour(): Collection
    {
        return $this->bonsRetour;
    }

    public function addBonRetour(BonRetour $bonRetour): self
    {
        if (!$this->bonsRetour->contains($bonRetour)) {
            $this->bonsRetour[] = $bonRetour;
            $bonRetour->setVente($this);
        }

        return $this;
    }

    public function removeBonRetour(BonRetour $bonRetour): self
    {
        if ($this->bonsRetour->removeElement($bonRetour)) {
            // set the owning side to null (unless already changed)
            if ($bonRetour->getVente() === $this) {
                $bonRetour->setVente(null);
            }
        }

        return $this;
    }

    private function generateUniqueBV(): string
    {
        return substr(str_shuffle(str_repeat($x='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', (int)ceil(10/strlen($x)))), 1, 10);
    }

    public function getIdVente(): ?int
    {
        return $this->idVente;
    }


    public function getNumCarteFidalite(): ?string
    {
        return $this->num_carte_fidalite;
    }

    public function setNumCarteFidalite(string $num_carte_fidalite): self
    {
        $this->num_carte_fidalite = $num_carte_fidalite;

        return $this;
    }

    /**
     * @return array<array{article: int, quantity: int, prixTTC: float, remise: float, totalTTC: float}>
     */
    public function getListeArticles(): array
    {
        return $this->listeArticles;
    }

    /**
     * @param array<array{article: int, quantity: int, prixTTC: float, remise: float, totalTTC: float}> $listeArticles
     */
    public function setListeArticles(array $listeArticles): static
    {
        $this->listeArticles = $listeArticles;

        return $this;
    }

    public function getRemiseGlobale(): ?float
    {
        return $this->remiseGlobale;
    }

    public function setRemiseGlobale(float $remiseGlobale): static
    {
        $this->remiseGlobale = $remiseGlobale;

        return $this;
    }

    public function getNetApayer(): ?float
    {
        return $this->netApayer;
    }

    public function setNetApayer(float $netApayer): static
    {
        $this->netApayer = $netApayer;

        return $this;
    }

    public function getPayer(): ?float
    {
        return $this->payer;
    }

    public function setPayer(float $payer): static
    {
        $this->payer = $payer;

        return $this;
    }

    public function getARendre(): ?float
    {
        return $this->aRendre;
    }

    public function setARendre(float $aRendre): static
    {
        $this->aRendre = $aRendre;

        return $this;
    }

    public function getTotalTTC(): ?float
    {
        return $this->totalTTC;
    }

    public function setTotalTTC(float $totalTTC): static
    {
        $this->totalTTC = $totalTTC;

        return $this;
    }

    public function getDateAchat(): ?\DateTimeInterface
    {
        return $this->dateAchat;
    }

    public function setDateAchat(\DateTimeInterface $dateAchat): static
    {
        $this->dateAchat = $dateAchat;

        return $this;
    }

    public function getBV(): ?string
    {
        return $this->BV;
    }

    public function setBV(string $BV): static
    {
        $this->BV = $BV;

        return $this;
    }
    
    public function getIdCaisse(): ?int
    {
        return $this->id_caisse;
    }

    public function setIdCaisse(int $id_caisse): static
    {
        $this->id_caisse = $id_caisse;

        return $this;
    }
}
