<?php

namespace App\Entity;

use App\Repository\HematicBiometryRepository;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;

/**
 * @ORM\Entity(repositoryClass=HematicBiometryRepository::class)
 */
class HematicBiometry
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $hematocrit;

    /**
     * @ORM\Column(type="float")
     */
    private $hemoglobin;

    /**
     * @ORM\Column(type="float")
     */
    private $leukocytes;

    /**
     * @ORM\Column(type="float")
     */
    private $platelets;

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
     * @ORM\OneToOne(targetEntity=Record::class, mappedBy="hematicBiometry", cascade={"persist", "remove"})
     */
    private $record;

    public function getId()
    {
        return $this->id;
    }

    public function getHematocrit(): ?float
    {
        return $this->hematocrit;
    }

    public function setHematocrit(float $hematocrit): self
    {
        $this->hematocrit = $hematocrit;

        return $this;
    }

    public function getHemoglobin(): ?float
    {
        return $this->hemoglobin;
    }

    public function setHemoglobin(float $hemoglobin): self
    {
        $this->hemoglobin = $hemoglobin;

        return $this;
    }

    public function getLeukocytes(): ?float
    {
        return $this->leukocytes;
    }

    public function setLeukocytes(float $leukocytes): self
    {
        $this->leukocytes = $leukocytes;

        return $this;
    }

    public function getPlatelets(): ?float
    {
        return $this->platelets;
    }

    public function setPlatelets(float $platelets): self
    {
        $this->platelets = $platelets;

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
        $newHematicBiometry = null === $record ? null : $this;
        if ($record->getHematicBiometry() !== $newHematicBiometry) {
            $record->setHematicBiometry($newHematicBiometry);
        }

        return $this;
    }
}
