<?php

namespace App\Entity;

use App\Repository\RegimeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
#[ORM\Entity(repositoryClass: RegimeRepository::class)]
class Regime
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    #[Assert\NotBlank (message:'Regime Price cannot be blank')]
    #[Assert\Regex("/^[0-9]*$/", message:"Regime Price should not contain special characters")]
    private ?float $prixRegime = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\NotBlank (message:'Regime Type cannot be blank')]
    #[Assert\Regex("/^[a-zA-Z\s]+$/", message:"Regime Type should not contain special characters")]
    private ?string $typeRegime = null;


    #[ORM\Column(length: 255, nullable: true)]
    private ?string $reg = null;

    #[ORM\ManyToOne(inversedBy: 'regimes')]
    private ?Cabinet $idCabinet = null;


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



    public function getReg(): ?string
    {
        return $this->reg;
    }

    public function setReg(?string $reg): static
    {
        $this->reg = $reg;

        return $this;
    }


    public function __toString(): string
    {
        return $this->typeRegime;
    }

    public function getIdCabinet(): ?Cabinet
    {
        return $this->idCabinet;
    }

    public function setIdCabinet(?Cabinet $idCabinet): static
    {
        $this->idCabinet = $idCabinet;

        return $this;
    }
}
