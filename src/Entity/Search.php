<?php

namespace App\Entity;



class Search
{



    private $departements;


    private $instruments;



    public function getDepartements()
    {
        return $this->departements;
    }

    public function setDepartements($departements): self
    {
        $this->departements = $departements;

        return $this;
    }

    public function getInstruments()
    {
        return $this->instruments;
    }

    public function setInstruments( $instruments): self
    {
        $this->instruments = $instruments;

        return $this;
    }
}
