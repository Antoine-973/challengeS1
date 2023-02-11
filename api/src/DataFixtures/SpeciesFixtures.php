<?php

namespace App\DataFixtures;

use App\Entity\Species;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SpeciesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $dog = (new Species())
            ->setName('Chien')
            ->setDescription('Dog is a domesticated carnivorous mammal that is valued for its companionship and its ability to guard and hunt.');

        $manager->persist($dog);

        $cat = (new Species())
            ->setName('Chat')
            ->setDescription("Le Chat domestique (Felis silvestris catus) est la sous-espèce issue de la domestication du Chat sauvage (Felis silvestris), mammifère carnivore de la famille des Félidés.");

        $manager->persist($cat);

        $equine = (new Species())
            ->setName('Equide')
            ->setDescription("Mammifère à pattes terminées par un seul doigt (famille des équidés ; ex. le cheval, l'âne.");

        $manager->persist($equine);

        $goat = (new Species())
            ->setName('Caprin')
            ->setDescription("Animal de la sous-espèce de mammifère de l'ordre des ruminants, à cornes creuses et persistantes et à menton garni d'une barbe");

        $manager->persist($goat);

        $nac = (new Species())
            ->setName('NAC')
            ->setDescription("NAC est l'acronyme de Nouveaux Animaux de Compagnie. Il s'agit d'animaux de compagnie qui ne sont pas des chiens, des chats, des oiseaux, des poissons.");

        $manager->persist($nac);

        $sheep = (new Species())
            ->setName('Ovin')
            ->setDescription("Les Ovins sont un genre de mammifères appartenant à la grande famille des Bovidae. Ce genre comprend les moutons et mouflons et compte de une à neuf espèces selon les auteurs.");

        $manager->persist($sheep);

        $pig = (new Species())
            ->setName('Porc')
            ->setDescription("Le porc est un mammifère domestique de la famille des Suidae. Il est originaire d'Asie et d'Europe, mais il est aujourd'hui présent dans le monde entier.");

        $manager->persist($pig);

        $backyardBirds = (new Species())
            ->setName('Oiseaux de basses cours')
            ->setDescription("Les oiseaux de basse-cour sont des oiseaux domestiques qui vivent en captivité dans des enclos ou des volières.");

        $manager->persist($backyardBirds);

        $manager->flush();
    }
}
