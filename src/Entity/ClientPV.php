<?php

namespace App\Entity;

use App\Repository\ClientPVRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ClientPVRepository::class)]
class ClientPV
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idClient = null;

    #[ORM\Column(length: 255)]
    #[Groups("client:read")]
    #[Assert\NotBlank(message: 'Le nom et prénom ne peuvent pas être vides')]
    #[Assert\Regex(
        pattern: '/^[a-zA-Z]+ [a-zA-Z]+$/',
        message: 'Le nom et prénom doivent être deux mots séparés par un espace et composés de lettres uniquement.'
    )]
    private ?string $nom_prenom = null;

    #[ORM\Column(length: 10, unique: true)]
    #[Groups("client:read")]
    #[Assert\NotBlank(message: 'Le CIN ne peut pas être vide')]
    #[Assert\Regex(
        pattern: '/^\d{8,10}$/',
        message: 'Le CIN doit être une chaîne de caractères composée de 8 à 10 chiffres.'
    )]
    private ?string $cin = null;

    #[ORM\Column(length: 20, nullable: true)]
    #[Groups("client:read")]
    private ?string $num_carte_fidalite = null;

    #[ORM\Column(length: 14)]
    #[Groups("client:read")]
    #[Assert\NotBlank(message: 'Le numéro de téléphone ne peut pas être vide')]
    #[Assert\Regex(
        pattern: '/^[0-9]{8}$/',
        message: 'Le numéro de téléphone doit être une chaîne de 10 chiffres.'
    )]
    private ?string $num_tel = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    #[Groups("client:read")]
    #[Assert\NotBlank(message: 'La date de naissance ne peut pas être vide')]
    #[Assert\LessThanOrEqual(
        value: '-18 years',
        message: 'L\'âge minimum doit être de 18 ans.'
    )]
    private ?\DateTimeImmutable $date_naissance = null;

    #[ORM\Column(nullable: true)]
    #[Groups("client:read")]
    private ?int $points_carte_fidalite = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $cree_le = null;

    #[ORM\Column(nullable: true)]
    private ?string $cree_par = null;

    #[ORM\Column(nullable: true)]
    private ?bool $est_desactive = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Email(message: 'L\'adresse e-mail doit être valide')]
    private ?string $email = null;

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->idClient;
    }

    public function getNomPrenom(): ?string
    {
        return $this->nom_prenom;
    }

    public function setNomPrenom(string $nom_prenom): static
    {
        $this->nom_prenom = $nom_prenom;

        return $this;
    }

    public function getCreePar(): ?string
    {
        return $this->cree_par;
    }

    public function setCreePar(?string $cree_par): self
    {
        $this->cree_par = $cree_par;
        return $this;
    }

    public function getCin(): ?string
    {
        return $this->cin;
    }

    public function setCin(string $cin): static
    {
        $this->cin = $cin;

        return $this;
    }

    public function getNumCarteFidalite(): ?string
    {
        return $this->num_carte_fidalite;
    }

    public function setNumCarteFidalite(?string $num_carte_fidalite): static
    {
        $this->num_carte_fidalite = $num_carte_fidalite;

        return $this;
    }

    public function getNumTel(): ?string
    {
        return $this->num_tel;
    }

    public function setNumTel(string $num_tel): static
    {
        $this->num_tel = $num_tel;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeImmutable
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(\DateTimeImmutable $date_naissance): static
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    public function getPointsCarteFidalite(): ?int
    {
        return $this->points_carte_fidalite;
    }

    public function setPointsCarteFidalite(?int $points_carte_fidalite): static
    {
        $this->points_carte_fidalite = $points_carte_fidalite;

        return $this;
    }

    public function setTimestampsOnCreate(): void
    {
        $this->cree_le = new \DateTimeImmutable();
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
 
    public function isEstDesactive(): ?bool
    {
        return $this->est_desactive;
    }

    public function setEstDesactive(bool $est_desactive): static
    {
        $this->est_desactive = $est_desactive;

        return $this;
    }
}
