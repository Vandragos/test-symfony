<?php

namespace App\Entity;

use App\Repository\PersonnelRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersonnelRepository::class)]
class Personnel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false, unique: true)]
    private ?Utilisateur $utilisateur = null;

    #[ORM\ManyToOne(inversedBy: 'personnels')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Boutique $Boutique = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): static
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getBoutique(): ?Boutique
    {
        return $this->Boutique;
    }

    public function setBoutique(?Boutique $Boutique): static
    {
        $this->Boutique = $Boutique;

        return $this;
    }
}
