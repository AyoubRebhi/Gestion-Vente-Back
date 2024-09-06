<?php

namespace App\Entity;

use App\Repository\RemisePromotionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RemisePromotionRepository::class)]
class RemisePromotion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $libelle = null;

    #[ORM\Column(length: 10)]
    private ?string $remise_article = null;

    #[ORM\Column(length: 10)]
    private ?string $remise_client = null;

    #[ORM\Column]
    private ?bool $est_inclure_description = null;

    #[ORM\Column]
    private ?int $article_offert = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_debut = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_fin = null;

    #[ORM\Column(length: 25)]
    private ?string $valeur_remise = null;

    #[ORM\Column(length: 10)]
    private ?string $type_remise = null;

    #[ORM\Column]
    private ?bool $est_calcul_tranche = null;

    #[ORM\Column]
    private ?bool $est_montant_quantite = null;

    #[ORM\Column]
    private ?int $rang_remise = null;

    #[ORM\Column]
    private ?bool $est_desactive = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getRemiseArticle(): ?string
    {
        return $this->remise_article;
    }

    public function setRemiseArticle(string $remise_article): static
    {
        $this->remise_article = $remise_article;

        return $this;
    }

    public function getRemiseClient(): ?string
    {
        return $this->remise_client;
    }

    public function setRemiseClient(string $remise_client): static
    {
        $this->remise_client = $remise_client;

        return $this;
    }

    public function isEstInclureDescription(): ?bool
    {
        return $this->est_inclure_description;
    }

    public function setEstInclureDescription(bool $est_inclure_description): static
    {
        $this->est_inclure_description = $est_inclure_description;

        return $this;
    }

    public function getArticleOffert(): ?int
    {
        return $this->article_offert;
    }

    public function setArticleOffert(int $article_offert): static
    {
        $this->article_offert = $article_offert;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTimeInterface $date_debut): static
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(\DateTimeInterface $date_fin): static
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    public function getValeurRemise(): ?string
    {
        return $this->valeur_remise;
    }

    public function setValeurRemise(string $valeur_remise): static
    {
        $this->valeur_remise = $valeur_remise;

        return $this;
    }

    public function getTypeRemise(): ?string
    {
        return $this->type_remise;
    }

    public function setTypeRemise(string $type_remise): static
    {
        $this->type_remise = $type_remise;

        return $this;
    }

    public function isEstCalculTranche(): ?bool
    {
        return $this->est_calcul_tranche;
    }

    public function setEstCalculTranche(bool $est_calcul_tranche): static
    {
        $this->est_calcul_tranche = $est_calcul_tranche;

        return $this;
    }

    public function isEstMontantQuantite(): ?bool
    {
        return $this->est_montant_quantite;
    }

    public function setEstMontantQuantite(bool $est_montant_quantite): static
    {
        $this->est_montant_quantite = $est_montant_quantite;

        return $this;
    }

    public function getRangRemise(): ?int
    {
        return $this->rang_remise;
    }

    public function setRangRemise(int $rang_remise): static
    {
        $this->rang_remise = $rang_remise;

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
    
    public function valRemise(): string
    {
        return $this->type_remise === '%' ? '0' : '1';
    }
}
