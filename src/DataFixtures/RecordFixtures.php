<?php

namespace App\DataFixtures;

use App\Entity\Record;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class RecordFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('es_MX');

        for ($i = 0; $i < 1; $i++) {
            $record = new Record();
            $record->setAdmissionDate($faker->dateTime);
            $record->setIdCanonical($faker->randomNumber(8));
            $record->setStatus($faker->randomElement(['new', 'process']));
            $record->setEgressDate($faker->dateTime);
            $record->setEgressType($faker->randomElement(['Vivo', 'Fallecido']));
            $record->setRcpRequired($faker->boolean);
            $record->setTreatment($faker->paragraph);
            $record->setEgressNotes($faker->paragraph);
            $record->setVitalSigns($this->getReference(VitalSignsFixtures::VITAL_SIGNS_REFERENCE));
            $record->setTriage($this->getReference(TriageFixtures::TRIAGE_REFERENCE));
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

    public function getDependencies()
    {
        return [
            VitalSignsFixtures::class,
            TriageFixtures::class,
        ];
    }
}