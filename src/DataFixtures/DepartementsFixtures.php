<?php

namespace App\DataFixtures;

use App\Entity\Departements;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class DepartementsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $departement = new Departements();
        $departement->setNom('Eure');
        $manager->persist($departement);

        $departement = new Departements();
        $departement->setNom('Normandie');
        $manager->persist($departement);

        $departement = new Departements();
        $departement->setNom('Charente');
        $manager->persist($departement);

        $departement = new Departements();
        $departement->setNom('Vienne');
        $manager->persist($departement);

        $departement = new Departements();
        $departement->setNom('Bretagne');
        $manager->persist($departement);

        $departement = new Departements();
        $departement->setNom('Corse');
        $manager->persist($departement);

        $manager->flush();
    }
}
