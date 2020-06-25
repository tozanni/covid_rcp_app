<?php

namespace App\DataFixtures;

use App\Entity\HematicBiometry;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class HematicBiometryFixtures extends Fixture
{
    public const HEMATIC_BIOMETRY_REFERENCE = 'hematic_biometry';

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('es_MX');

        $hematicBiometry = new HematicBiometry();
        $hematicBiometry->setHematocrit($faker->numberBetween(1.0, 3.0));
        $hematicBiometry->setHemoglobin($faker->numberBetween(1.2, 2.0));
        $hematicBiometry->setLeukocytes($faker->numberBetween(1.0, 2.0));
        $hematicBiometry->setPlatelets($faker->numberBetween(1.0,5.0));
        $manager->persist($hematicBiometry);

        $manager->flush();

        $this->addReference(self::HEMATIC_BIOMETRY_REFERENCE, $hematicBiometry);
    }
}