<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups("article:read")]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups("article:read")]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups("article:read")]
    private ?string $description = null;

    #[ORM\Column]
    #[Groups("article:read")]
    private ?float $prix_achat_ht = null;

    #[ORM\Column]
    #[Groups("article:read")]
    private ?float $prix_achat_ttc = null;

    #[ORM\Column]
    #[Groups("article:read")]
    private ?float $prix_vente_ht = null;

    #[ORM\Column]
    #[Groups("article:read")]
    
    private ?float $prix_vente_ttc = null;

    #[ORM\Column]
    private ?bool $est_affiche_ttc = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(length: 255)]
    #[Groups("article:read")]
    private ?string $reference = null;

    #[ORM\Column]
    private ?bool $est_service = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $cree_le = null;

    #[ORM\Column(nullable: true)]
    private ?string $cree_par = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $modifier_le = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $modifier_par = null;
    
    #[ORM\Column(nullable: true)]
    private ?bool $est_supprime = null;

    #[ORM\Column(nullable: true)]
    private ?bool $est_bloque = null;

    #[ORM\Column(length: 255)]
    #[Groups("article:read")]
    private ?string $code_barre = null;

    #[ORM\Column(nullable: true)]
    private ?int $periode_garentie = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fixe = null;

    #[ORM\Column(nullable: true)]
    private ?float $coefficient = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $serie_lot = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $poids_net = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $poids_brut = null;

    #[ORM\Column(nullable: true)]
    private ?float $qte_par_colis = null;

    #[ORM\Column(nullable: true)]
    private ?bool $est_desactive = null;

    #[ORM\Column(nullable: true)]
    private ?int $cree_par_id = null;

    #[ORM\Column(nullable: true)]
    private ?int $modifier_par_id = null;

    #[ORM\Column(nullable: true)]
    private ?int $marque_id = null;

    #[ORM\Column(nullable: true)]
    private ?int $eco_participation_id = null;

    #[ORM\Column(nullable: true)]
    private ?int $tva_achat_id = null;

    #[ORM\Column(nullable: true)]
    private ?int $tva_vente_id = null;

    #[ORM\Column(nullable: true)]
    private ?int $tpf_achat_id = null;

    #[ORM\Column(nullable: true)]
    private ?int $tpf_vente_id = null;

    #[ORM\Column(nullable: true)]
    private ?int $conditionnement_achat_id = null;

    #[ORM\Column(nullable: true)]
    private ?int $conditionnement_vente_id = null;

    #[ORM\Column]
    private ?bool $est_divers = null;

    #[ORM\Column]
    private ?bool $est_publier_web = null;

    #[ORM\Column]
    private ?bool $est_contre_marque = null;

    #[ORM\Column]
    private ?bool $est_gestion_stock = null;

    #[ORM\Column(nullable: true)]
    private ?int $devise_id = null;

    #[ORM\Column(nullable: true)]
    private ?int $tva_id = null;

    #[ORM\Column(nullable: true)]
    #[Groups("article:read")]
    private ?int $famille_article_id = null;

    #[ORM\Column(nullable: true)]
    private ?int $unite_id = null;

    #[ORM\Column(nullable: true)]
    private ?int $categorie_depense_id = null;

    #[ORM\Column(nullable: true)]
    private ?bool $est_depense = null;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPrixAchatHt(): ?float
    {
        return $this->prix_achat_ht;
    }

    public function setPrixAchatHt(float $prix_achat_ht): static
    {
        $this->prix_achat_ht = $prix_achat_ht;

        return $this;
    }

    public function getPrixAchatTtc(): ?float
    {
        return $this->prix_achat_ttc;
    }

    public function setPrixAchatTtc(float $prix_achat_ttc): static
    {
        $this->prix_achat_ttc = $prix_achat_ttc;

        return $this;
    }

    public function getPrixVenteHt(): ?float
    {
        return $this->prix_vente_ht;
    }

    public function setPrixVenteHt(float $prix_vente_ht): static
    {
        $this->prix_vente_ht = $prix_vente_ht;

        return $this;
    }

    public function getPrixVenteTtc(): ?float
    {
        return $this->prix_vente_ttc;
    }

    public function setPrixVenteTtc(float $prix_vente_ttc): static
    {
        $this->prix_vente_ttc = $prix_vente_ttc;

        return $this;
    }

    public function isEstAfficheTtc(): ?bool
    {
        return $this->est_affiche_ttc;
    }

    public function setEstAfficheTtc(bool $est_affiche_ttc): static
    {
        $this->est_affiche_ttc = $est_affiche_ttc;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): static
    {
        $this->reference = $reference;

        return $this;
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

    public function getCreeLe(): ?\DateTimeImmutable
    {
        return $this->cree_le;
    }

    public function setCreeLe(?\DateTimeImmutable $cree_le): static
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

    public function getModifierLe(): ?\DateTimeImmutable
    {
        return $this->modifier_le;
    }

    public function setModifierLe(?\DateTimeImmutable $modifier_le): static
    {
        $this->modifier_le = $modifier_le;

        return $this;
    }

    public function getModifierPar(): ?string
    {
        return $this->modifier_par;
    }

    public function setModifierPar(?string $modifier_par): static
    {
        $this->modifier_par = $modifier_par;

        return $this;
    }
    
    public function isEstSupprime(): ?bool
    {
        return $this->est_supprime;
    }

    public function setEstSupprime(?bool $est_supprime): static
    {
        $this->est_supprime = $est_supprime;

        return $this;
    }

    public function isEstBloque(): ?bool
    {
        return $this->est_bloque;
    }

    public function setEstBloque(?bool $est_bloque): static
    {
        $this->est_bloque = $est_bloque;

        return $this;
    }

    public function getCodeBarre(): ?string
    {
        return $this->code_barre;
    }

    public function setCodeBarre(string $code_barre): self
    {
        $this->code_barre = $code_barre;

        return $this;
    }

    public function getPeriodeGarentie(): ?int
    {
        return $this->periode_garentie;
    }

    public function setPeriodeGarentie(?int $periode_garentie): static
    {
        $this->periode_garentie = $periode_garentie;

        return $this;
    }

    public function getFixe(): ?string
    {
        return $this->fixe;
    }

    public function setFixe(?string $fixe): static
    {
        $this->fixe = $fixe;

        return $this;
    }

    public function getCoefficient(): ?float
    {
        return $this->coefficient;
    }

    public function setCoefficient(?float $coefficient): static
    {
        $this->coefficient = $coefficient;

        return $this;
    }

    public function getSerieLot(): ?string
    {
        return $this->serie_lot;
    }

    public function setSerieLot(?string $serie_lot): static
    {
        $this->serie_lot = $serie_lot;

        return $this;
    }

    public function getPoidsNet(): ?string
    {
        return $this->poids_net;
    }

    public function setPoidsNet(?string $poids_net): static
    {
        $this->poids_net = $poids_net;

        return $this;
    }

    public function getPoidsBrut(): ?string
    {
        return $this->poids_brut;
    }

    public function setPoidsBrut(?string $poids_brut): static
    {
        $this->poids_brut = $poids_brut;

        return $this;
    }

    public function getQteParColis(): ?float
    {
        return $this->qte_par_colis;
    }

    public function setQteParColis(?float $qte_par_colis): static
    {
        $this->qte_par_colis = $qte_par_colis;

        return $this;
    }

    public function isEstDesactive(): ?bool
    {
        return $this->est_desactive;
    }

    public function setEstDesactive(?bool $est_desactive): static
    {
        $this->est_desactive = $est_desactive;

        return $this;
    }

    public function getCreeParId(): ?int
    {
        return $this->cree_par_id;
    }

    public function setCreeParId(?int $cree_par_id): static
    {
        $this->cree_par_id = $cree_par_id;

        return $this;
    }

    public function getModifierParId(): ?int
    {
        return $this->modifier_par_id;
    }

    public function setModifierParId(?int $modifier_par_id): static
    {
        $this->modifier_par_id = $modifier_par_id;

        return $this;
    }

    public function getMarqueId(): ?int
    {
        return $this->marque_id;
    }

    public function setMarqueId(?int $marque_id): static
    {
        $this->marque_id = $marque_id;

        return $this;
    }

    public function getEcoParticipationId(): ?int
    {
        return $this->eco_participation_id;
    }

    public function setEcoParticipationId(?int $eco_participation_id): static
    {
        $this->eco_participation_id = $eco_participation_id;

        return $this;
    }

    public function getTvaAchatId(): ?int
    {
        return $this->tva_achat_id;
    }

    public function setTvaAchatId(?int $tva_achat_id): static
    {
        $this->tva_achat_id = $tva_achat_id;

        return $this;
    }

    public function getTvaVenteId(): ?int
    {
        return $this->tva_vente_id;
    }

    public function setTvaVenteId(?int $tva_vente_id): static
    {
        $this->tva_vente_id = $tva_vente_id;

        return $this;
    }

    public function getTpfAchatId(): ?int
    {
        return $this->tpf_achat_id;
    }

    public function setTpfAchatId(?int $tpf_achat_id): static
    {
        $this->tpf_achat_id = $tpf_achat_id;

        return $this;
    }

    public function getTpfVenteId(): ?int
    {
        return $this->tpf_vente_id;
    }

    public function setTpfVenteId(?int $tpf_vente_id): static
    {
        $this->tpf_vente_id = $tpf_vente_id;

        return $this;
    }

    public function getConditionnementAchatId(): ?int
    {
        return $this->conditionnement_achat_id;
    }

    public function setConditionnementAchatId(?int $conditionnement_achat_id): static
    {
        $this->conditionnement_achat_id = $conditionnement_achat_id;

        return $this;
    }

    public function getConditionnementVenteId(): ?int
    {
        return $this->conditionnement_vente_id;
    }

    public function setConditionnementVenteId(?int $conditionnement_vente_id): static
    {
        $this->conditionnement_vente_id = $conditionnement_vente_id;

        return $this;
    }

    public function isEstDivers(): ?bool
    {
        return $this->est_divers;
    }

    public function setEstDivers(bool $est_divers): static
    {
        $this->est_divers = $est_divers;

        return $this;
    }

    public function isEstPublierWeb(): ?bool
    {
        return $this->est_publier_web;
    }

    public function setEstPublierWeb(bool $est_publier_web): static
    {
        $this->est_publier_web = $est_publier_web;

        return $this;
    }

    public function isEstContreMarque(): ?bool
    {
        return $this->est_contre_marque;
    }

    public function setEstContreMarque(bool $est_contre_marque): static
    {
        $this->est_contre_marque = $est_contre_marque;

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

    public function getDeviseId(): ?int
    {
        return $this->devise_id;
    }

    public function setDeviseId(?int $devise_id): static
    {
        $this->devise_id = $devise_id;

        return $this;
    }

    public function getTvaId(): ?int
    {
        return $this->tva_id;
    }

    public function setTvaId(?int $tva_id): static
    {
        $this->tva_id = $tva_id;

        return $this;
    }

    public function getFamilleArticleId(): ?int
    {
        return $this->famille_article_id;
    }

    public function setFamilleArticleId(?int $famille_article_id): static
    {
        $this->famille_article_id = $famille_article_id;

        return $this;
    }

    public function getUniteId(): ?int
    {
        return $this->unite_id;
    }

    public function setUniteId(?int $unite_id): static
    {
        $this->unite_id = $unite_id;

        return $this;
    }

    public function getCategorieDepenseId(): ?int
    {
        return $this->categorie_depense_id;
    }

    public function setCategorieDepenseId(?int $categorie_depense_id): static
    {
        $this->categorie_depense_id = $categorie_depense_id;

        return $this;
    }

    public function isEstDepense(): ?bool
    {
        return $this->est_depense;
    }

    public function setEstDepense(?bool $est_depense): static
    {
        $this->est_depense = $est_depense;

        return $this;
    }
}
