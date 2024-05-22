<?php

namespace App\Entity;

use App\Repository\StockRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: StockRepository::class)]
class Stock
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'stocks')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups('boutiqueInfo')]
    private ?Article $article = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    #[Groups('boutiqueInfo')]
    private ?string $tarifLocationJour = null;

    #[ORM\Column]
    private ?int $stock = null;

    #[ORM\ManyToOne(inversedBy: 'stocks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Boutique $boutique = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): static
    {
        $this->article = $article;

        return $this;
    }

    public function getTarifLocationJour(): ?string
    {
        return $this->tarifLocationJour;
    }

    public function setTarifLocationJour(string $tarifLocationJour): static
    {
        $this->tarifLocationJour = $tarifLocationJour;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): static
    {
        $this->stock = $stock;

        return $this;
    }

    public function getBoutique(): ?Boutique
    {
        return $this->boutique;
    }

    public function setBoutique(?Boutique $boutique): static
    {
        $this->boutique = $boutique;

        return $this;
    }
}
