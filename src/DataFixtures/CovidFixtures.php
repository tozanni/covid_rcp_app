<?php

namespace App\DataFixtures;

use App\Entity\Covid;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CovidFixtures extends Fixture
{
    public const COVID_REFERENCE = 'covid';

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('es_MX');

        $covid = new Covid();
        $covid->setPcr($faker->boolean);
        $covid->setLdh($faker->numberBetween(1.0, 3.0));
        $covid->setIl6($faker->numberBetween(1.0, 3.0));
        $covid->setFerritin($faker->numberBetween(1.0, 3.0));
        $covid->setTroponin($faker->numberBetween(1.0, 3.0));
        $covid->setIgm($faker->numberBetween(1.0, 3.0));
        $covid->setIgg($faker->numberBetween(1.0, 3.0));
        $manager->persist($covid);

        $this->setReference(self::COVID_REFERENCE, $covid);

        $manager->flush();
    }
}
