<?php

namespace App\DataFixtures;

use App\Entity\Species;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SpeciesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $dog = (new Species())
            ->setName('Dog')
            ->setDescription('Dog is a domesticated carnivorous mammal that is valued for its companionship and its ability to guard and hunt.');

        $manager->persist($dog);

        $cat = (new Species())
            ->setName('Cat')
            ->setDescription("Le Chat domestique (Felis silvestris catus) est la sous-espèce issue de la domestication du Chat sauvage (Felis silvestris), mammifère carnivore de la famille des Félidés.");

        $manager->persist($cat);

        $horse = (new Species())
            ->setName('Horse')
            ->setDescription("Le cheval est un grand mammifère herbivore et ongulé à sabot unique, c'est l'une des espèces de la famille des Équidés");

        $manager->persist($horse);

        $manager->flush();
    }
}
