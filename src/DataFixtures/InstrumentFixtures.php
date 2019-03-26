<?php

namespace App\DataFixtures;

use App\Entity\Instrument;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class InstrumentFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $instruments = [
        'accordeon',
        'banjo',
        'batterie',
        'bongos',
        'clarinette',
        'clarinette basse',
        'clavecin',
        'clavier electronique',
        'contrebasse',
        'Cornemuse',
        'cymbales',
        'djembe',
        'flute traversiere',
        'guitare acoustique ou folk ',
        'guitare basse ',
        'guitare classique',
        'guitare electrique',
        'harpe',
        'harmonica',
        'hautbois',
        'luth',
        'marimba',
        'mandoline',
        'orge',
        'piano a queu',
        'piano droit',
        'piano electrique',
        'saxophone alto',
        'saxophone barython',
        'saxophone soprano',
        'saxophone tenor',
        'synthetiseur',
        'trombone',
        'trompette',
        'triangle',
        'violon',
        'violon alto',
        'violoncelle',
        'xylophone'];

        foreach ($instruments as $instrument) {
          $instru = new Instrument();
          $instru->setNom($instrument);
          $instru->setCategorie('1');
          $manager->persist($instru);
        }

        $manager->flush();
    }
}
