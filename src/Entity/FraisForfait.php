<?php

namespace App\Entity;

use App\Repository\FraisForfaitRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FraisForfaitRepository::class)
 */
class FraisForfait
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fraisForfaitLibelle;

    /**
     * @ORM\Column(type="integer")
     */
    private $montant;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFraisForfaitLibelle(): ?string
    {
        return $this->fraisForfaitLibelle;
    }

    public function setFraisForfaitLibelle(string $fraisForfaitLibelle): self
    {
        $this->fraisForfaitLibelle = $fraisForfaitLibelle;

        return $this;
    }

    public function getMontant(): ?int
    {
        return $this->montant;
    }

    public function setMontant(int $montant): self
    {
        $this->montant = $montant;

        return $this;
    }
}
