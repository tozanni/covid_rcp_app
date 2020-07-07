<?php

namespace App\DataFixtures;

use App\Entity\BloodChemistry;
use App\Entity\HematicBiometry;
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
            $record->setStatus($faker->sentence(3));
            $record->setEgressDate($faker->dateTime);
            $record->setEgressType($faker->randomElement(['Vivo', 'Fallecido']));
            $record->setRcpRequired($faker->boolean);
            $record->setTreatment($faker->paragraph);
            $record->setEgressNotes($faker->paragraph);
            $record->setVitalSigns($this->getReference(VitalSignsFixtures::VITAL_SIGNS_REFERENCE));
            $record->setTriage($this->getReference(TriageFixtures::TRIAGE_REFERENCE));
            $record->setHematicBiometry($this->getReference(HematicBiometryFixtures::HEMATIC_BIOMETRY_REFERENCE));
            $record->setBloodChemistry($this->getReference(BloodChemistryFixtures::BLOOD_CHEMISTRY_REFERENCE));
            $record->setSerumElectrolytes($this->getReference(SerumElectrolytesFixtures::SERUM_ELECTROLYTES_REFERENCE));
            $record->setMedicalNotes($this->getReference(MedicalNotesFixtures::MEDICAL_NOTES_REFERENCE));
            $record->setLiverFunction($this->getReference(LiverFunctionFixtures::LIVER_FUNCTION_REFERENCE));
            $record->setClottingTime($this->getReference(ClottingTimeFixtures::CLOTTING_TIME_REFERENCE));
            $record->setImmunological($this->getReference(ImmunologicalFixtures::IMMUNOLOGICAL_REFERENCE));
            $manager->persist($record);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            VitalSignsFixtures::class,
            TriageFixtures::class,
            HematicBiometryFixtures::class,
            BloodChemistryFixtures::class,
            SerumElectrolytesFixtures::class,
            MedicalNotesFixtures::class,
            LiverFunctionFixtures::class,
            ClottingTimeFixtures::class,
            ImmunologicalFixtures::class,
        ];
    }
}