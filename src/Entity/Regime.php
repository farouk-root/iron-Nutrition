<?php

namespace App\Entity;

use App\Repository\RegimeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RegimeRepository::class)]
class Regime
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?float $prixRegime = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $typeRegime = null;

    #[ORM\ManyToOne(inversedBy: 'regimes')]
    private ?Cabinet $nomMED = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $prenomMED = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $reg = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $idmed = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrixRegime(): ?float
    {
        return $this->prixRegime;
    }

    public function setPrixRegime(?float $prixRegime): static
    {
        $this->prixRegime = $prixRegime;

        return $this;
    }

    public function getTypeRegime(): ?string
    {
        return $this->typeRegime;
    }

    public function setTypeRegime(?string $typeRegime): static
    {
        $this->typeRegime = $typeRegime;

        return $this;
    }

    public function getNomMED(): ?Cabinet
    {
        return $this->nomMED;
    }

    public function setNomMED(?Cabinet $nomMED): static
    {
        $this->nomMED = $nomMED;

        return $this;
    }

    public function getPrenomMED(): ?string
    {
        return $this->prenomMED;
    }

    public function setPrenomMED(?string $prenomMED): static
    {
        $this->prenomMED = $prenomMED;

        return $this;
    }

    public function getReg(): ?string
    {
        return $this->reg;
    }

    public function setReg(?string $reg): static
    {
        $this->reg = $reg;

        return $this;
    }

    public function getIdmed(): ?string
    {
        return $this->idmed;
    }

    public function setIdmed(?string $idmed): static
    {
        $this->idmed = $idmed;

        return $this;
    }
}
