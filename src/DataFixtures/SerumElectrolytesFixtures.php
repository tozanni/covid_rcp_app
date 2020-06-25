<?php

namespace App\DataFixtures;

use App\Entity\SerumElectrolytes;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class SerumElectrolytesFixtures extends Fixture
{
    public const SERUM_ELECTROLYTES_REFERENCE = 'serum_electrolytes';

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('es_MX');
        $serumElectrolytes = new SerumElectrolytes();
        $serumElectrolytes->setSodium($faker->numberBetween(1.0, 3.0));
        $serumElectrolytes->setPotassium($faker->numberBetween(1.0, 3.0));
        $manager->persist($serumElectrolytes);

        $manager->flush();

        $this->setReference(self::SERUM_ELECTROLYTES_REFERENCE, $serumElectrolytes);
    }
}
