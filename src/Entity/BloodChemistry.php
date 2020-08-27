<?php

namespace App\Entity;

use App\Repository\BloodChemistryRepository;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass=BloodChemistryRepository::class)
 * @Serializer\ExclusionPolicy("all")
 * @Gedmo\Loggable
 */
class BloodChemistry
{
    use EntityTrait;

    /**
     * @Gedmo\Versioned
     * @ORM\Column(type="float", nullable=true)
     * @Serializer\Expose()
     */
    private $glucose;

    /**
     * @Gedmo\Versioned
     * @ORM\Column(type="float", nullable=true)
     * @Serializer\Expose()
     */
    private $urea;

    /**
     * @Gedmo\Versioned
     * @ORM\Column(type="float", nullable=true)
     * @Serializer\Expose()
     */
    private $creatinine;

    /**
     * @Gedmo\Versioned
     * @ORM\Column(type="float", nullable=true)
     * @Serializer\Expose()
     */
    private $cholesterol;

    /**
     * @Gedmo\Versioned
     * @ORM\Column(type="float", nullable=true)
     * @Serializer\Expose()
     */
    private $triglycerides;

    /**
     * @Gedmo\Versioned
     * @ORM\Column(type="float", nullable=true)
     * @Serializer\Expose()
     */
    private $glycated_hemoglobin;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime_immutable")
     */
    private $created_at;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime_immutable")
     */
    private $updated_at;

    /**
     * @ORM\OneToOne(targetEntity=Record::class, mappedBy="bloodChemistry", cascade={"persist", "remove"})
     */
    private $record;

    public function getGlucose(): ?float
    {
        return $this->glucose;
    }

    public function setGlucose(?float $glucose): self
    {
        $this->glucose = $glucose;

        return $this;
    }

    public function getUrea(): ?float
    {
        return $this->urea;
    }

    public function setUrea(?float $urea): self
    {
        $this->urea = $urea;

        return $this;
    }

    public function getCreatinine(): ?float
    {
        return $this->creatinine;
    }

    public function setCreatinine(?float $creatinine): self
    {
        $this->creatinine = $creatinine;

        return $this;
    }

    public function getCholesterol(): ?float
    {
        return $this->cholesterol;
    }

    public function setCholesterol(?float $cholesterol): self
    {
        $this->cholesterol = $cholesterol;

        return $this;
    }

    public function getTriglycerides(): ?float
    {
        return $this->triglycerides;
    }

    public function setTriglycerides(?float $triglycerides): self
    {
        $this->triglycerides = $triglycerides;

        return $this;
    }

    public function getGlycatedHemoglobin(): ?float
    {
        return $this->glycated_hemoglobin;
    }

    public function setGlycatedHemoglobin(?float $glycated_hemoglobin): self
    {
        $this->glycated_hemoglobin = $glycated_hemoglobin;

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

    public function getRecord(): ?Record
    {
        return $this->record;
    }

    public function setRecord(?Record $record): self
    {
        $this->record = $record;

        // set (or unset) the owning side of the relation if necessary
        $newBloodChemistry = null === $record ? null : $this;
        if ($record->getBloodChemistry() !== $newBloodChemistry) {
            $record->setBloodChemistry($newBloodChemistry);
        }

        return $this;
    }
}
