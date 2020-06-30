<?php

namespace App\DataFixtures;

use App\Entity\VitalSigns;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class VitalSignsFixtures extends Fixture
{
    public const VITAL_SIGNS_REFERENCE = 'vital-signs';

    public function load(ObjectManager $manager)
    {

        $faker = Faker\Factory::create('es_MX');

        $vitalSigns = new VitalSigns();
        $vitalSigns->setAge($faker->numberBetween(1, 99));
        $vitalSigns->setGender($faker->randomElement(['male', 'female']));
        $vitalSigns->setWeight($faker->numberBetween(15, 70));
        $vitalSigns->setHeight($faker->numberBetween(1.55, 2.35));
        $vitalSigns->setDiastolicBloodPressure($faker->randomFloat());
        $vitalSigns->setSystolicBloodPressure($faker->randomFloat());
        $vitalSigns->setHeartRate($faker->randomNumber(2));
        $vitalSigns->setBreathingFrequency($faker->randomFloat());
        $vitalSigns->setTemperature($faker->numberBetween(30, 38));
        $vitalSigns->setOximetry($faker->randomFloat());
        $vitalSigns->setOximetry($faker->randomFloat());
        $vitalSigns->setCapillaryGlucose($faker->randomFloat());

        $manager->persist($vitalSigns);

        $manager->flush();

        $this->addReference(self::VITAL_SIGNS_REFERENCE, $vitalSigns);
    }
}