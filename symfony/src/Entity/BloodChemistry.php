<?php

namespace App\Entity;

use App\Repository\BloodChemistryRepository;
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
     * @ORM\Column(type="integer")
     */
    private $glucose;

    /**
     * @ORM\Column(type="integer")
     */
    private $urea;

    /**
     * @ORM\Column(type="integer")
     */
    private $creatinine;

    /**
     * @ORM\Column(type="integer")
     */
    private $cholesterol;

    /**
     * @ORM\Column(type="integer")
     */
    private $triglycerides;

    /**
     * @ORM\Column(type="integer")
     */
    private $glycated_hemoglobin;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGlucose(): ?int
    {
        return $this->glucose;
    }

    public function setGlucose(int $glucose): self
    {
        $this->glucose = $glucose;

        return $this;
    }

    public function getUrea(): ?int
    {
        return $this->urea;
    }

    public function setUrea(int $urea): self
    {
        $this->urea = $urea;

        return $this;
    }

    public function getCreatinine(): ?int
    {
        return $this->creatinine;
    }

    public function setCreatinine(int $creatinine): self
    {
        $this->creatinine = $creatinine;

        return $this;
    }

    public function getCholesterol(): ?int
    {
        return $this->cholesterol;
    }

    public function setCholesterol(int $cholesterol): self
    {
        $this->cholesterol = $cholesterol;

        return $this;
    }

    public function getTriglycerides(): ?int
    {
        return $this->triglycerides;
    }

    public function setTriglycerides(int $triglycerides): self
    {
        $this->triglycerides = $triglycerides;

        return $this;
    }

    public function getGlycatedHemoglobin(): ?int
    {
        return $this->glycated_hemoglobin;
    }

    public function setGlycatedHemoglobin(int $glycated_hemoglobin): self
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
}
