<?php

namespace App\DataFixtures;

use App\Entity\Instruments;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class InstrumentsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $instrument = new Instruments();
        $instrument->setNom('Guitare');
        $manager->persist($instrument);

        $instrument = new Instruments();
        $instrument->setNom('Batterie');
        $manager->persist($instrument);

        $instrument = new Instruments();
        $instrument->setNom('Violon');
        $manager->persist($instrument);

        $instrument = new Instruments();
        $instrument->setNom('Triangle');
        $manager->persist($instrument);

        $instrument = new Instruments();
        $instrument->setNom('Saxophone');
        $manager->persist($instrument);

        $manager->flush();
    }
}
