<?php

namespace App\Entity;


class Search
{



    private $departements;


    private $instruments;



    public function getDepartements(): ?string
    {
        return $this->departements;
    }

    public function setDepartements(?string $departement): self
    {
        $this->departement = $departement;

        return $this;
    }

    public function getInstruments(): ?string
    {
        return $this->instruments;
    }

    public function setInstruments(?string $instruments): self
    {
        $this->instruments = $instruments;

        return $this;
    }
}
