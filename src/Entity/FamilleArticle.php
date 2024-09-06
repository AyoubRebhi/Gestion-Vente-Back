<?php

namespace App\Entity;

use App\Repository\FamilleArticleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FamilleArticleRepository::class)]
class FamilleArticle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $est_service = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column(length: 255)]
    private ?string $code = null;

    #[ORM\Column]
    private ?bool $est_default = null;

    #[ORM\Column]
    private ?bool $est_desactive = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $cree_le = null;

    #[ORM\Column(length:50)]
    private ?string $cree_par = null;

    #[ORM\Column]
    private ?int $cree_par_id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $modifier_le = null;

    #[ORM\Column(length: 50)]
    private ?string $modifier_par = null;

    #[ORM\Column]
    private ?int $modifier_par_id = null;

    #[ORM\Column]
    private ?bool $est_predefini = null;

    #[ORM\Column]
    private ?int $conditionnement_vente_id = null;

    #[ORM\Column]
    private ?int $conditionnement_achat_id = null;

    #[ORM\Column]
    private ?bool $est_gestion_stock = null;

    #[ORM\Column(length: 7)]
    private ?string $numero_serie_lot = null;

    #[ORM\Column]
    private ?float $coeff_marge = null;

    #[ORM\Column]
    private ?int $periode_garantie = null;

    #[ORM\Column]
    private ?bool $contremarque = null;

    #[ORM\Column]
    private ?int $depot_favori = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isEstService(): ?bool
    {
        return $this->est_service;
    }

    public function setEstService(bool $est_service): static
    {
        $this->est_service = $est_service;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function isEstDefault(): ?bool
    {
        return $this->est_default;
    }

    public function setEstDefault(bool $est_default): static
    {
        $this->est_default = $est_default;

        return $this;
    }

    public function isEstDesactive(): ?bool
    {
        return $this->est_desactive;
    }

    public function setEstDesactive(bool $est_desactive): static
    {
        $this->est_desactive = $est_desactive;

        return $this;
    }

    public function getCreeLe(): ?\DateTimeInterface
    {
        return $this->cree_le;
    }

    public function setCreeLe(\DateTimeInterface $cree_le): static
    {
        $this->cree_le = $cree_le;

        return $this;
    }

    public function getCreePar(): ?string
    {
        return $this->cree_par;
    }


    public function setCreePar(?string $cree_par): static
    {
        $this->cree_par = $cree_par;
        return $this;
    }


    public function getCreeParId(): ?int
    {
        return $this->cree_par_id;
    }

    public function setCreeParId(int $cree_par_id): static
    {
        $this->cree_par_id = $cree_par_id;

        return $this;
    }

    public function getModifierLe(): ?\DateTimeInterface
    {
        return $this->modifier_le;
    }

    public function setModifierLe(\DateTimeInterface $modifier_le): static
    {
        $this->modifier_le = $modifier_le;

        return $this;
    }

    public function getModifierPar(): ?string
    {
        return $this->modifier_par;
    }

    public function setModifierPar(string $modifier_par): static
    {
        $this->modifier_par = $modifier_par;

        return $this;
    }

    public function getModifierParId(): ?int
    {
        return $this->modifier_par_id;
    }

    public function setModifierParId(int $modifier_par_id): static
    {
        $this->modifier_par_id = $modifier_par_id;

        return $this;
    }

    public function isEstPredefini(): ?bool
    {
        return $this->est_predefini;
    }

    public function setEstPredefini(bool $est_predefini): static
    {
        $this->est_predefini = $est_predefini;

        return $this;
    }

    public function getConditionnementVenteId(): ?int
    {
        return $this->conditionnement_vente_id;
    }

    public function setConditionnementVenteId(int $conditionnement_vente_id): static
    {
        $this->conditionnement_vente_id = $conditionnement_vente_id;

        return $this;
    }

    public function getConditionnementAchatId(): ?int
    {
        return $this->conditionnement_achat_id;
    }

    public function setConditionnementAchatId(int $conditionnement_achat_id): static
    {
        $this->conditionnement_achat_id = $conditionnement_achat_id;

        return $this;
    }

    public function isEstGestionStock(): ?bool
    {
        return $this->est_gestion_stock;
    }

    public function setEstGestionStock(bool $est_gestion_stock): static
    {
        $this->est_gestion_stock = $est_gestion_stock;

        return $this;
    }

    public function getNumeroSerieLot(): ?string
    {
        return $this->numero_serie_lot;
    }

    public function setNumeroSerieLot(string $numero_serie_lot): static
    {
        $this->numero_serie_lot = $numero_serie_lot;

        return $this;
    }

    public function getCoeffMarge(): ?float
    {
        return $this->coeff_marge;
    }

    public function setCoeffMarge(float $coeff_marge): static
    {
        $this->coeff_marge = $coeff_marge;

        return $this;
    }

    public function getPeriodeGarantie(): ?int
    {
        return $this->periode_garantie;
    }

    public function setPeriodeGarantie(int $periode_garantie): static
    {
        $this->periode_garantie = $periode_garantie;

        return $this;
    }

    public function isContremarque(): ?bool
    {
        return $this->contremarque;
    }

    public function setContremarque(bool $contremarque): static
    {
        $this->contremarque = $contremarque;

        return $this;
    }

    public function getDepotFavori(): ?int
    {
        return $this->depot_favori;
    }

    public function setDepotFavori(int $depot_favori): static
    {
        $this->depot_favori = $depot_favori;

        return $this;
    }
}
