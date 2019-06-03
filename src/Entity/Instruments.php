<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InstrumentsRepository")
 */
class Instruments
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UsersInstruments", mappedBy="Instrument")
     */
    private $usersInstruments;

    public function __construct()
    {
        $this->usersInstruments = new ArrayCollection();
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

    /**
     * @return Collection|UsersInstruments[]
     */
    public function getUsersInstruments(): Collection
    {
        return $this->usersInstruments;
    }

    public function addUsersInstrument(UsersInstruments $usersInstrument): self
    {
        if (!$this->usersInstruments->contains($usersInstrument)) {
            $this->usersInstruments[] = $usersInstrument;
            $usersInstrument->setInstrument($this);
        }

        return $this;
    }

    public function removeUsersInstrument(UsersInstruments $usersInstrument): self
    {
        if ($this->usersInstruments->contains($usersInstrument)) {
            $this->usersInstruments->removeElement($usersInstrument);
            // set the owning side to null (unless already changed)
            if ($usersInstrument->getInstrument() === $this) {
                $usersInstrument->setInstrument(null);
            }
        }

        return $this;
    }
}
