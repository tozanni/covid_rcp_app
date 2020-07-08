<?php

namespace App\Entity;

use App\Repository\TriageRepository;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=TriageRepository::class)
 * @Serializer\ExclusionPolicy("all")
 */
class Triage
{
    use EntityTrait;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $days_before_admission;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $difficulty_breathing;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $chest_pain;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $headache;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $cough;

    /**
     * @ORM\Column(type="json", nullable=true)
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $other_symptoms = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $comorbidities = [];

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $smoker;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $pregnant;

    /**
     * @ORM\OneToOne(targetEntity=Record::class, mappedBy="triage", cascade={"persist", "remove"})
     */
    private $record;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime_immutable")
     * @Serializer\Expose()
     */
    private $created_at;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime_immutable")
     * @Serializer\Expose()
     */
    private $updated_at;

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

    public function getHeadache(): ?int
    {
        return $this->headache;
    }

    public function setHeadache(int $headache): self
    {
        $this->headache = $headache;

        return $this;
    }

    public function getCough(): ?int
    {
        return $this->cough;
    }

    public function setCough(int $cough): self
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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeImmutable $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
