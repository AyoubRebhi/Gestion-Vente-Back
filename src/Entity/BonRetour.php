<?php

namespace App\Entity;

use App\Repository\BonRetourRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: BonRetourRepository::class)]
class BonRetour
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    #[Groups("bonRetour:read")]
    private ?string $num_carte_fidalite = null;

    /**
     * @var array<int, array{article: int, quantity: int, prixTTC: float, remise: float, totalTTC: float}>
     */
    #[ORM\Column(type: 'json')]
    #[Groups("bonRetour:read")]
    private array $articlesRetours = [];

    #[ORM\Column(type: 'float')]
    #[Groups("bonRetour:read")]
    private float $totalRetour;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups("bonRetour:read")]
    private ?\DateTimeInterface $dateRetour = null;

    #[ORM\Column(type: 'string', length: 10)]
    #[Groups("bonRetour:read")]
    private string $BV;

    #[ORM\ManyToOne(targetEntity: Vente::class, inversedBy: 'bonsRetour')]
    #[ORM\JoinColumn(name: 'vente_id', referencedColumnName: 'id_vente', nullable: false)]
    #[Groups("bonRetour:read")]
    private ?Vente $vente = null;

    public function getId(): ?int
    {
        return $this->id;
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
     * @return array<int, array{article: int, quantity: int, prixTTC: float, remise: float, totalTTC: float}>
     */
    public function getArticlesRetours(): array
    {
        return $this->articlesRetours;
    }

    /**
     * @param array<int, array{article: int, quantity: int, prixTTC: float, remise: float, totalTTC: float}> $articlesRetours
     */
    public function setArticlesRetours(array $articlesRetours): self
    {
        $this->articlesRetours = $articlesRetours;
        return $this;
    }

    public function getTotalRetour(): float
    {
        return $this->totalRetour;
    }

    public function setTotalRetour(float $totalRetour): self
    {
        $this->totalRetour = $totalRetour;
        return $this;
    }

    public function getDateRetour(): ?\DateTimeInterface
    {
        return $this->dateRetour;
    }

    public function setDateRetour(\DateTimeInterface $dateRetour): self
    {
        $this->dateRetour = $dateRetour;
        return $this;
    }

    public function getBV(): string
    {
        return $this->BV;
    }

    public function setBV(string $BV): self
    {
        $this->BV = $BV;
        return $this;
    }

    public function getVente(): ?Vente
    {
        return $this->vente;
    }

    public function setVente(?Vente $vente): self
    {
        $this->vente = $vente;
        return $this;
    }
}
