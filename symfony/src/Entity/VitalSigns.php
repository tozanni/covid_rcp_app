<?php

namespace App\Entity;

use App\Repository\VitalSignsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VitalSignsRepository::class)
 */
class VitalSigns
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $age;

    /**
     * @ORM\Column(type="string", length=12)
     */
    private $gender;

    /**
     * @ORM\Column(type="integer")
     */
    private $weight;

    /**
     * @ORM\Column(type="integer")
     */
    private $height;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private $diastolic_blood_pressure;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private $systolic_blood_pressure;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private $heart_rate;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private $breathing_frequency;

    /**
     * @ORM\Column(type="float")
     */
    private $temperature;

    /**
     * @ORM\Column(type="integer")
     */
    private $oximetry;

    /**
     * @ORM\Column(type="integer")
     */
    private $capillary_glucose;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    /**
     * @ORM\OneToOne(targetEntity=Record::class, mappedBy="vitalSigns", cascade={"persist", "remove"})
     */
    private $record;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAge(): ?\DateTimeInterface
    {
        return $this->age;
    }

    public function setAge(\DateTimeInterface $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(int $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getDiastolicBloodPressure(): ?int
    {
        return $this->diastolic_blood_pressure;
    }

    public function setDiastolicBloodPressure(int $diastolic_blood_pressure): self
    {
        $this->diastolic_blood_pressure = $diastolic_blood_pressure;

        return $this;
    }

    public function getSystolicBloodPressure(): ?int
    {
        return $this->systolic_blood_pressure;
    }

    public function setSystolicBloodPressure(int $systolic_blood_pressure): self
    {
        $this->systolic_blood_pressure = $systolic_blood_pressure;

        return $this;
    }

    public function getHeartRate(): ?int
    {
        return $this->heart_rate;
    }

    public function setHeartRate(int $heart_rate): self
    {
        $this->heart_rate = $heart_rate;

        return $this;
    }

    public function getBreathingFrequency(): ?int
    {
        return $this->breathing_frequency;
    }

    public function setBreathingFrequency(int $breathing_frequency): self
    {
        $this->breathing_frequency = $breathing_frequency;

        return $this;
    }

    public function getTemperature(): ?float
    {
        return $this->temperature;
    }

    public function setTemperature(float $temperature): self
    {
        $this->temperature = $temperature;

        return $this;
    }

    public function getOximetry(): ?int
    {
        return $this->oximetry;
    }

    public function setOximetry(int $oximetry): self
    {
        $this->oximetry = $oximetry;

        return $this;
    }

    public function getCapillaryGlucose(): ?int
    {
        return $this->capillary_glucose;
    }

    public function setCapillaryGlucose(int $capillary_glucose): self
    {
        $this->capillary_glucose = $capillary_glucose;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

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
        $newVitalSigns = null === $record ? null : $this;
        if ($record->getVitalSigns() !== $newVitalSigns) {
            $record->setVitalSigns($newVitalSigns);
        }

        return $this;
    }
}
