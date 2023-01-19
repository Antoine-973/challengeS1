<?php

namespace App\DataFixtures;

use App\Entity\Spa;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class SpaFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {

            $city = $faker->city;

            $spa = (new Spa())
                ->setName("SPA $city")
                ->setDescription($faker->text)
                ->setAddress($faker->address)
                ->setCity($city)
                ->setZipCode($faker->postcode)
                ->setPhoneNumber($faker->phoneNumber)
                ->setEmail($faker->email)
            ;
            $manager->persist($spa);
        }

        $manager->flush();
    }
}
