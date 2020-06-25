<?php

namespace App\DataFixtures;

use App\Entity\Immunological;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ImmunologicalFixtures extends Fixture
{
    public const IMMUNOLOGICAL_REFERENCE = 'immunological';

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('es_MX');

        $immunological = new Immunological();
        $immunological->setReactiveProteinC($faker->numberBetween(1.0, 3.0));
        $manager->persist($immunological);

        $manager->flush();

        $this->setReference(self::IMMUNOLOGICAL_REFERENCE, $immunological);
    }
}