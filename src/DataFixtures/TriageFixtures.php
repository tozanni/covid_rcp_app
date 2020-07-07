<?php

namespace App\DataFixtures;

use App\Entity\Triage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class TriageFixtures extends Fixture
{
    public const TRIAGE_REFERENCE = 'triage';

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('es_MX');

        $triage = new Triage();
        $triage->setDaysBeforeAdmission($faker->randomNumber(2));
        $triage->setDifficultyBreathing($faker->boolean);
        $triage->setChestPain($faker->boolean);
        $triage->setHeadache($faker->boolean);
        $triage->setCough($faker->boolean);
        $triage->setOtherSymptoms((array) [
            "conjunctivitis", "articulations_pain", "diarrhea",
            "muscle_pain", "sore_throat", "shaking_chills"
        ]);
        $triage->setComorbidities([
            "anemia", "coronary_atherosclerosis", "cancer", "cardiovascular",
            "diabetes", "gestational_diabetes"
        ]);
        $triage->setSmoker($faker->boolean);
        $triage->setPregnant($faker->boolean);
        $manager->persist($triage);

        $manager->flush();

        $this->addReference(self::TRIAGE_REFERENCE, $triage);
    }
}