<?php

namespace App\DataFixtures;

use App\Entity\Behaviour;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BehaviourFixtures extends Fixture
{
    public function load(ObjectManager $manager) :void
    {
        $joueur = (new Behaviour())
            ->setName('Joueur')
            ->setDescription("L'animal est joueur et aime jouer avec ses maîtres ou ses congénères.");

        $manager->persist($joueur);

        $calme = (new Behaviour())
            ->setName('Calme')
            ->setDescription("L'animal est calme et ne fait pas de bêtises.");

        $manager->persist($calme);

        $curieux = (new Behaviour())
            ->setName('Curieux')
            ->setDescription("L'animal est curieux et aime découvrir de nouvelles choses.");

        $manager->persist($curieux);

        $timide = (new Behaviour())
            ->setName('Timide')
            ->setDescription("L'animal est timide et a besoin de temps pour s'habituer à son nouvel environnement.");

        $manager->persist($timide);

        $protecteur = (new Behaviour())
            ->setName('Protecteur')
            ->setDescription("L'animal est protecteur et aime protéger ses maîtres ou ses congénères.");

        $manager->persist($protecteur);

        $sociable = (new Behaviour())
            ->setName('Sociable')
            ->setDescription("L'animal est sociable et aime les autres animaux.");

        $manager->persist($sociable);

        $craintif = (new Behaviour())
            ->setName('Craintif')
            ->setDescription("L'animal est craintif et a besoin de temps pour s'habituer à son nouvel environnement.");

        $manager->persist($craintif);

        $calin = (new Behaviour())
            ->setName('Câlin')
            ->setDescription("L'animal est câlin et aime être caressé.");

        $manager->persist($calin);

        $fougueux = (new Behaviour())
            ->setName('Fougueux')
            ->setDescription("L'animal est fougueux et aime bouger.");

        $manager->persist($fougueux);

        $bruyant = (new Behaviour())
            ->setName('Bruyant')
            ->setDescription("L'animal est bruyant et aime faire du bruit.");

        $manager->persist($bruyant);

        $manager->flush();
    }
}
