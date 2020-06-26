<?php

namespace App\Entity;

use App\Repository\VitalSignsRepository;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VitalSignsRepository::class)
 */
class VitalSigns
{
    use EntityTrait;

    /**
     * @ORM\Column(type="date")
     */
    private $age;

    /**
     * @ORM\Column(type="string", length=12)
     */
    private $gender;

    /**
     * @ORM\Column(type="float")
     */
    private $weight;

    /**
     * @ORM\Column(type="float")
     */
    private $height;

    /**
     * @ORM\Column(type="float", nullable=false)
     */
    private $diastolic_blood_pressure;

    /**
     * @ORM\Column(type="float", nullable=false)
     */
    private $systolic_blood_pressure;

    /**
     * @ORM\Column(type="float", nullable=false)
     */
    private $heart_rate;

    /**
     * @ORM\Column(type="float", nullable=false)
     */
    private $breathing_frequency;

    /**
     * @ORM\Column(type="float")
     */
    private $temperature;

    /**
     * @ORM\Column(type="float")
     */
    private $oximetry;

    /**
     * @ORM\Column(type="float")
     */
    private $capillary_glucose;

    /**
     * @ORM\OneToOne(targetEntity=Record::class, mappedBy="vitalSigns",
     *     cascade={"persist", "remove"})
     */
    private $record;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

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

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(float $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getHeight(): ?float
    {
        return $this->height;
    }

    public function setHeight(float $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getDiastolicBloodPressure(): ?float
    {
        return $this->diastolic_blood_pressure;
    }

    public function setDiastolicBloodPressure(float $diastolic_blood_pressure): self
    {
        $this->diastolic_blood_pressure = $diastolic_blood_pressure;

        return $this;
    }

    public function getSystolicBloodPressure(): ?float
    {
        return $this->systolic_blood_pressure;
    }

    public function setSystolicBloodPressure(float $systolic_blood_pressure): self
    {
        $this->systolic_blood_pressure = $systolic_blood_pressure;

        return $this;
    }

    public function getHeartRate(): ?float
    {
        return $this->heart_rate;
    }

    public function setHeartRate(float $heart_rate): self
    {
        $this->heart_rate = $heart_rate;

        return $this;
    }

    public function getBreathingFrequency(): ?float
    {
        return $this->breathing_frequency;
    }

    public function setBreathingFrequency(float $breathing_frequency): self
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

    public function getOximetry(): ?float
    {
        return $this->oximetry;
    }

    public function setOximetry(float $oximetry): self
    {
        $this->oximetry = $oximetry;

        return $this;
    }

    public function getCapillaryGlucose(): ?float
    {
        return $this->capillary_glucose;
    }

    public function setCapillaryGlucose(float $capillary_glucose): self
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
