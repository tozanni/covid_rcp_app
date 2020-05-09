<?php

namespace App\Entity;

use App\Repository\TriageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TriageRepository::class)
 */
class Triage
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $days_before_admission;

    /**
     * @ORM\Column(type="boolean")
     */
    private $difficulty_breathing;

    /**
     * @ORM\Column(type="boolean")
     */
    private $chest_pain;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $headache;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $cough;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $other_symptoms = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $comorbidities = [];

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $smoker;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $pregnant;

    /**
     * @ORM\OneToOne(targetEntity=Record::class, mappedBy="triage", cascade={"persist", "remove"})
     */
    private $record;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDaysBeforeAdmission(): ?int
    {
        return $this->days_before_admission;
    }

    public function setDaysBeforeAdmission(int $days_before_admission): self
    {
        $this->days_before_admission = $days_before_admission;

        return $this;
    }

    public function getDifficultyBreathing(): ?bool
    {
        return $this->difficulty_breathing;
    }

    public function setDifficultyBreathing(bool $difficulty_breathing): self
    {
        $this->difficulty_breathing = $difficulty_breathing;

        return $this;
    }

    public function getChestPain(): ?bool
    {
        return $this->chest_pain;
    }

    public function setChestPain(bool $chest_pain): self
    {
        $this->chest_pain = $chest_pain;

        return $this;
    }

    public function getHeadache(): ?string
    {
        return $this->headache;
    }

    public function setHeadache(string $headache): self
    {
        $this->headache = $headache;

        return $this;
    }

    public function getCough(): ?string
    {
        return $this->cough;
    }

    public function setCough(string $cough): self
    {
        $this->cough = $cough;

        return $this;
    }

    public function getOtherSymptoms(): ?array
    {
        return $this->other_symptoms;
    }

    public function setOtherSymptoms(?array $other_symptoms): self
    {
        $this->other_symptoms = $other_symptoms;

        return $this;
    }

    public function getComorbidities(): ?array
    {
        return $this->comorbidities;
    }

    public function setComorbidities(?array $comorbidities): self
    {
        $this->comorbidities = $comorbidities;

        return $this;
    }

    public function getSmoker(): ?bool
    {
        return $this->smoker;
    }

    public function setSmoker(?bool $smoker): self
    {
        $this->smoker = $smoker;

        return $this;
    }

    public function getPregnant(): ?bool
    {
        return $this->pregnant;
    }

    public function setPregnant(?bool $pregnant): self
    {
        $this->pregnant = $pregnant;

        return $this;
    }

    public function getRecord(): ?Record
    {
        return $this->record;
    }

    public function setRecord(?Record $record): self
    {
        $this->record = $record;

        // set (or unset) the owning side of the relation if necessary
        $newTriage = null === $record ? null : $this;
        if ($record->getTriage() !== $newTriage) {
            $record->setTriage($newTriage);
        }

        return $this;
    }
}
