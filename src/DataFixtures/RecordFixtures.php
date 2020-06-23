<?php

namespace App\DataFixtures;

use App\Entity\Record;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class RecordFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('es_MX');

        for ($i = 0; $i < 10; $i++) {
            $record = new Record();
            $record->setAdmissionDate($faker->dateTime);
            $record->setIdCanonical($faker->word);
            $record->setStatus($faker->randomElement(['new', 'process']));
            $record->setEgressDate($faker->dateTime);
            $record->setEgressType($faker->randomElement(['Vivo', 'Fallecido']));
            $record->setRcpRequired($faker->boolean);
            $record->setTreatment($faker->paragraph);
            $record->setEgressNotes($faker->paragraph);
            //$record->setVitalSigns();
            //$record->setTriage();
            //$record->setHematicBiometry();
            //$record->setBloodChemistry();
            //$record->setSerumElectrolytes();
            //$record->setMedicalNotes();
            //$record->setLiverFunction();
            //$record->setClottingTime();
            //$record->setImmunological();
            $manager->persist($record);
        }

        $manager->flush();
    }
}
