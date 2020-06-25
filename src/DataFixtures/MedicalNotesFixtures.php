<?php

namespace App\DataFixtures;

use App\Entity\MedicalNotes;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class MedicalNotesFixtures extends Fixture
{
    public const MEDICAL_NOTES_REFERENCE = 'medical_notes';

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('es_MX');
        $medicalNotes = new MedicalNotes();
        $medicalNotes->setNotes($faker->paragraph);
        $medicalNotes->setPrescriptionDrugs($faker->paragraph);
        $manager->persist($medicalNotes);

        $manager->flush();

        $this->setReference(self::MEDICAL_NOTES_REFERENCE, $medicalNotes);
    }
}
