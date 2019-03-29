<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InstrumentRepository")
 */
class Instrument
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Length(min=6)
     * @Assert\Length(max=30)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank
     * @Assert\Length(min=6)
     * @Assert\Length(max=30)
     */
    private $categorie;

    public function __construct()
    {
        $this->userInstruments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(?string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection|UserInstrument[]
     */
    public function getUserInstruments(): Collection
    {
        return $this->userInstruments;
    }

    public function addUserInstrument(UserInstrument $userInstrument): self
    {
        if (!$this->userInstruments->contains($userInstrument)) {
            $this->userInstruments[] = $userInstrument;
            $userInstrument->setInstrument($this);
        }

        return $this;
    }

    public function removeUserInstrument(UserInstrument $userInstrument): self
    {
        if ($this->userInstruments->contains($userInstrument)) {
            $this->userInstruments->removeElement($userInstrument);
            // set the owning side to null (unless already changed)
            if ($userInstrument->getInstrument() === $this) {
                $userInstrument->setInstrument(null);
            }
        }

        return $this;
    }
}
