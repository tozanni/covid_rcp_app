<?php

namespace App\DataFixtures;

use App\Entity\Imaging;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ImagingFixtures extends Fixture
{
    public const IMAGING_REFERENCE = 'imaging';

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('es_MX');

        $imaging = new Imaging();
        $imaging->setChestXRay($faker->boolean);
        $imaging->setResult($faker->randomElement([
            "normal", "infiltrate", "apical_pneumatic_foci", "basal_pneumatic_foci",
            "bilateral_pneumatic_foci", "generalized_pneumatic_foci", "medial_pneumatic_foci",
            "unilateral_pneumatic_foci"
        ]));
        $manager->persist($imaging);

        $manager->flush();

        $this->addReference(self::IMAGING_REFERENCE, $imaging);
    }
}