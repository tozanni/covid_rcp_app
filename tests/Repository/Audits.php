<?php

namespace App\Tests\Entity;

use App\Entity\VitalSigns;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * @author Enrique García <enrique@inodata.mx>
 * Date: 07/09/20 Time: 22:55
 */
class Audits extends KernelTestCase
{
    private $entityManager;

    public function setUp()
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function tearDown()
    {
        parent::tearDown();
        $this->entityManager->close();
        $this->entityManager = null;
    }

    /** @test */
    public function serumElectrolytes()
    {
        $serumElectrolytes = new \App\Entity\SerumElectrolytes();
        $serumElectrolytes->setSodium(1.2);
        $serumElectrolytes->setPotassium(1.3);
        $this->entityManager->persist($serumElectrolytes);
        $this->entityManager->flush();

        $this->assertEquals(1.2, $serumElectrolytes->getSodium());

        $serumElectrolytes->setSodium(1.5);
        $this->entityManager->flush();

        $this->assertEquals(1.5, $serumElectrolytes->getSodium());

        $serumElectrolytes->setPotassium(1.99);
        $this->entityManager->flush();

        $repo = $this->entityManager->getRepository('\App\Entity\SerumElectrolytes');

        $this->assertEquals(2, sizeof($repo->audits($serumElectrolytes)));
    }

    /** @test */
    public function vitalSigns()
    {
        $faker = \Faker\Factory::create('es_MX');

        $vitalSigns = new VitalSigns();
        $vitalSigns->setAge($faker->dateTime);
        $vitalSigns->setGender($faker->randomElement(['male', 'female']));
        $vitalSigns->setWeight($faker->numberBetween(15, 99));
        $vitalSigns->setHeight($faker->randomFloat(2, 1.55, 2.35));
        $vitalSigns->setDiastolicBloodPressure($faker->randomFloat());
        $vitalSigns->setSystolicBloodPressure($faker->randomFloat());
        $vitalSigns->setHeartRate($faker->randomNumber(2));
        $vitalSigns->setBreathingFrequency($faker->randomFloat());
        $vitalSigns->setTemperature($faker->randomFloat(2, 30, 38));
        $vitalSigns->setOximetry($faker->randomFloat(2, 90, 96));
        $vitalSigns->setCapillaryGlucose($faker->randomFloat(2, 79, 80));
        $this->entityManager->persist($vitalSigns);
        $this->entityManager->flush();


        $vitalSigns->setBreathingFrequency($faker->randomFloat());
        $vitalSigns->setHeight($faker->randomFloat(2, 1.55, 2.35));
        $this->entityManager->flush();

        $vitalSigns->setWeight($faker->numberBetween(15, 99));
        $vitalSigns->setCapillaryGlucose($faker->randomFloat(2, 79, 80));
        $this->entityManager->flush();

        $repo = $this->entityManager->getRepository('\App\Entity\VitalSigns');
        $this->assertEquals(11, sizeof($repo->audits($vitalSigns)));
    }


}