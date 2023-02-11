<?php

namespace App\DataFixtures;

use App\Entity\Animal;
use App\Entity\Behaviour;
use App\Entity\Breed;
use App\Entity\Spa;
use App\Entity\Species;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AnimalFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $dog = $manager->getRepository(Species::class)->findOneBy(['name' => 'Chien']);
        $cairnTerrier = $manager->getRepository(Breed::class)->findOneBy(['name' => 'Cairn Terrier']);
        $behaviours = $manager->getRepository(Behaviour::class)->findAll();
        $spas = $manager->getRepository(Spa::class)->findAll();
        $faker = Factory::create('fr_FR');

        $adibou = (new Animal())
            ->setName('Adibou')
            ->setBirthday(new \DateTime('2005-01-20'))
            ->setDescription("Adibou le plus beau des chiens")
            ->setIsSterilize(false)
            ->setBirthLocation('Bretagne')
            ->setSex(1)
            ->setSpecies($dog)
            ->setSpa($faker->randomElement($spas))
            ->addBreed($cairnTerrier);

        $adibouBehaviours = $faker->randomElements($behaviours, 3);
        foreach ($adibouBehaviours as $adibouBehaviour) {
            $adibou->addBehaviour($adibouBehaviour);
        }

        $manager->persist($adibou);

        $cat = $manager->getRepository(Species::class)->findOneBy(['name' => 'Chat']);
        $crossbreed = $manager->getRepository(Breed::class)->findOneBy(['name' => 'Croise / Autre']);

        $socrate = (new Animal())
            ->setName('Socrate')
            ->setBirthday(new \DateTime('2021-06-01'))
            ->setDescription("Socrate le plus beau des chats @aventures_socrate_sera")
            ->setIsSterilize(false)
            ->setBirthLocation('La street')
            ->setSex(1)
            ->setSpecies($cat)
            ->setSpa($faker->randomElement($spas))
            ->addBreed($crossbreed);

        $socrateBehaviours = $faker->randomElements($behaviours, 3);
        foreach ($socrateBehaviours as $socrateBehaviour) {
            $socrate->addBehaviour($socrateBehaviour);
        }

        $manager->persist($socrate);

        $sera = (new Animal())
            ->setName('Séra')
            ->setBirthday(new \DateTime('2021-06-01'))
            ->setDescription("Sera le plus beau des chates @aventures_socrate_sera")
            ->setIsSterilize(false)
            ->setBirthLocation('La street')
            ->setSex(2)
            ->setSpecies($cat)
            ->setSpa($faker->randomElement($spas))
            ->addBreed($crossbreed);

        $seraBehaviours = $faker->randomElements($behaviours, 3);
        foreach ($seraBehaviours as $seraBehaviour) {
            $sera->addBehaviour($seraBehaviour);
        }

        $manager->persist($sera);

        $species = $manager->getRepository(Species::class)->findAll();

        for($i = 0; $i <= 100; $i++) {
            $animalSpecies = $faker->randomElement($species);
            $breeds = $animalSpecies->getBreeds();
            if (count($breeds) >= 2){
                $animalBreeds = $faker->randomElements($breeds, 2);
            }
            else {
                $animalBreeds = $faker->randomElement($breeds);
            }

            $animal = (new Animal())
                ->setName($faker->firstName)
                ->setBirthday($faker->dateTimeBetween('-10 years', '-1 years'))
                ->setDescription($faker->text(200))
                ->setIsSterilize($faker->boolean)
                ->setBirthLocation($faker->city)
                ->setSex($faker->numberBetween(1, 2))
                ->setSpecies($faker->randomElement($species))
                ->setSpa($faker->randomElement($spas));

            foreach ($animalBreeds as $animalBreed) {
                $animal->addBreed($animalBreed);
            }

            $animalBehaviours = $faker->randomElements($behaviours, 3);
            foreach ($animalBehaviours as $animalBehaviour) {
                $animal->addBehaviour($animalBehaviour);
            }

            $manager->persist($animal);
        }

        $manager->flush();

    }


    public function getDependencies() : array
    {
        return [
            SpeciesFixtures::class,
            BreedFixtures::class,
            BehaviourFixtures::class,
            SpaFixtures::class,
        ];
    }
}
