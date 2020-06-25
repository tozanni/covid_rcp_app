<?php

namespace App\DataFixtures;

use App\Entity\ClottingTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ClottingTimeFixtures extends Fixture
{
    public const CLOTTING_TIME_REFERENCE = 'clotting_time';

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('es_MX');

        $clottingTime = new ClottingTime();
        $clottingTime->setProthrombin($faker->numberBetween(1.0, 3.0));
        $clottingTime->setThromboplastin($faker->numberBetween(1.0, 3.0));
        $manager->persist($clottingTime);

        $manager->flush();

        $this->setReference(self::CLOTTING_TIME_REFERENCE, $clottingTime);
    }
}