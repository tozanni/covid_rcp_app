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
        $triage->setHeadache($faker->numberBetween(0, 3));
        $triage->setCough($faker->numberBetween(0, 3));
        $triage->setOtherSymptoms([
            "conjunctivitis", "articulations_pain", "diarrhea", "fatigue_and_weakness",
            "muscle_pain", "sore_throat_or_pain", "shaking_chills", "nausea", "sweating", "threw_up"
        ]);
        $triage->setComorbidities([
            "anemia", "coronary_atherosclerosis", "cancer", "cardiovascular", "glaucoma",
            "diabetes_1_and_2", "gestational_diabetes", "cardiac_arrhythmias", "seizures_or_epilepsy",
            "hepatic_cirrhosis", "hypertension", "immunological", "leukemia", "neurological",
            "osteoporosis", "parkinson_s", "high_pressure", "pulmonary", "chronic_kidney",
            "immunosuppressive_treatment", "hiv",
        ]);
        $triage->setSmoker($faker->boolean);
        $triage->setPregnant($faker->boolean);
        $manager->persist($triage);

        $manager->flush();

        $this->addReference(self::TRIAGE_REFERENCE, $triage);
    }
}