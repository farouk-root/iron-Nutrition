<?php

namespace App\Entity;

use App\Repository\CabinetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CabinetRepository::class)]
class Cabinet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nomMED = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $prenomMED = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $specialite = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adresse = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $tel = null;

    #[ORM\OneToMany(mappedBy: 'nomMED', targetEntity: Regime::class)]
    private Collection $regimes;

    public function __construct()
    {
        $this->regimes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomMED(): ?string
    {
        return $this->nomMED;
    }

    public function setNomMED(?string $nomMED): static
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

    public function getSpecialite(): ?string
    {
        return $this->specialite;
    }

    public function setSpecialite(?string $specialite): static
    {
        $this->specialite = $specialite;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): static
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * @return Collection<int, Regime>
     */
    public function getRegimes(): Collection
    {
        return $this->regimes;
    }

    public function addRegime(Regime $regime): static
    {
        if (!$this->regimes->contains($regime)) {
            $this->regimes->add($regime);
            $regime->setNomMED($this);
        }

        return $this;
    }

    public function removeRegime(Regime $regime): static
    {
        if ($this->regimes->removeElement($regime)) {
            // set the owning side to null (unless already changed)
            if ($regime->getNomMED() === $this) {
                $regime->setNomMED(null);
            }
        }

        return $this;
    }
}
