<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersInstrumentsRepository")
 */
class UsersInstruments
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="usersInstruments")
     */
    private $User;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Instruments", inversedBy="usersInstruments")
     */
    private $Instrument;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getInstrument(): ?Instruments
    {
        return $this->Instrument;
    }

    public function setInstrument(?Instruments $Instrument): self
    {
        $this->Instrument = $Instrument;

        return $this;
    }
}
