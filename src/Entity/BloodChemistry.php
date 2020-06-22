<?php

namespace App\Entity;

use App\Repository\BloodChemistryRepository;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BloodChemistryRepository::class)
 */
class BloodChemistry
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal")
     */
    private $glucose;

    /**
     * @ORM\Column(type="decimal")
     */
    private $urea;

    /**
     * @ORM\Column(type="decimal")
     */
    private $creatinine;

    /**
     * @ORM\Column(type="decimal")
     */
    private $cholesterol;

    /**
     * @ORM\Column(type="decimal")
     */
    private $triglycerides;

    /**
     * @ORM\Column(type="decimal")
     */
    private $glycated_hemoglobin;

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

    /**
     * @ORM\OneToOne(targetEntity=Record::class, mappedBy="bloodChemistry", cascade={"persist", "remove"})
     */
    private $record;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGlucose(): ?string
    {
        return $this->glucose;
    }

    public function setGlucose(string $glucose): self
    {
        $this->glucose = $glucose;

        return $this;
    }

    public function getUrea(): ?string
    {
        return $this->urea;
    }

    public function setUrea(string $urea): self
    {
        $this->urea = $urea;

        return $this;
    }

    public function getCreatinine(): ?string
    {
        return $this->creatinine;
    }

    public function setCreatinine(string $creatinine): self
    {
        $this->creatinine = $creatinine;

        return $this;
    }

    public function getCholesterol(): ?string
    {
        return $this->cholesterol;
    }

    public function setCholesterol(string $cholesterol): self
    {
        $this->cholesterol = $cholesterol;

        return $this;
    }

    public function getTriglycerides(): ?string
    {
        return $this->triglycerides;
    }

    public function setTriglycerides(string $triglycerides): self
    {
        $this->triglycerides = $triglycerides;

        return $this;
    }

    public function getGlycatedHemoglobin(): ?string
    {
        return $this->glycated_hemoglobin;
    }

    public function setGlycatedHemoglobin(string $glycated_hemoglobin): self
    {
        $this->glycated_hemoglobin = $glycated_hemoglobin;

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
        $newBloodChemistry = null === $record ? null : $this;
        if ($record->getBloodChemistry() !== $newBloodChemistry) {
            $record->setBloodChemistry($newBloodChemistry);
        }

        return $this;
    }
}
