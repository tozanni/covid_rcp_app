<?php

namespace App\DataFixtures;

use App\Entity\BloodChemistry;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class BloodChemistryFixtures extends Fixture
{
    public const BLOOD_CHEMISTRY_REFERENCE = 'blood_reference';

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('es_MX');

        $bloodChemistry = new BloodChemistry();
        $bloodChemistry->setGlucose($faker->numberBetween(1.0, 3.0));
        $bloodChemistry->setUrea($faker->numberBetween(1.0, 3.0));
        $bloodChemistry->setCreatinine($faker->numberBetween(1.0, 3.0));
        $bloodChemistry->setCholesterol($faker->numberBetween(1.0, 3.0));
        $bloodChemistry->setTriglycerides($faker->numberBetween(1.0, 3.0));
        $bloodChemistry->setGlycatedHemoglobin($faker->numberBetween(1.0, 3.0));
        $manager->persist($bloodChemistry);

        $manager->flush();

        $this->setReference(self::BLOOD_CHEMISTRY_REFERENCE, $bloodChemistry);
    }
}