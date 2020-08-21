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
        $covid->setLdh($faker->randomFloat());
        $covid->setIl6($faker->randomFloat());
        $covid->setFerritin($faker->randomFloat());
        $covid->setTroponin($faker->randomFloat());
        $covid->setIgm($faker->randomFloat());
        $covid->setIgg($faker->randomFloat());
        $manager->persist($covid);

        $this->setReference(self::COVID_REFERENCE, $covid);

        $manager->flush();
    }
}
