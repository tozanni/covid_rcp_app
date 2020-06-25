<?php

namespace App\DataFixtures;

use App\Entity\LiverFunction;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class LiverFunctionFixtures extends Fixture
{
    public const LIVER_FUNCTION_REFERENCE = 'liver_function';

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('es_MX');

        $liverFunction = new LiverFunction();
        $liverFunction->setAspartateAminotransferase($faker->numberBetween(1.0, 3.0));
        $liverFunction->setAlanineTransaminase($faker->numberBetween(1.0, 3.0));
        $liverFunction->setBloodUreaNitrogen($faker->numberBetween(1.0, 3.0));
        $manager->persist($liverFunction);

        $manager->flush();

        $this->setReference(self::LIVER_FUNCTION_REFERENCE, $liverFunction);
    }
}