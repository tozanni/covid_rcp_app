<?php

namespace App\Entity;

use App\Repository\MedicalNotesRepository;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Loggable\MedicalNotes as LogEntity;

/**
 * @ORM\Entity(repositoryClass=MedicalNotesRepository::class)
 * @Serializer\ExclusionPolicy("all")
 * @Gedmo\Loggable(logEntryClass=LogEntity::class)
 */
class MedicalNotes
{
    use EntityTrait;

    /**
     * @Gedmo\Versioned
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $notes;

    /**
     * @Gedmo\Versioned
     * @ORM\Column(type="text", nullable=true)
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $prescription_drugs;

    /**
     * @ORM\OneToOne(targetEntity=Record::class, mappedBy="medicalNotes",
     *     cascade={"persist", "remove"})
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

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(string $notes): self
    {
        $this->notes = $notes;

        return $this;
    }

    public function getPrescriptionDrugs(): ?string
    {
        return $this->prescription_drugs;
    }

    public function setPrescriptionDrugs(?string $prescription_drugs): self
    {
        $this->prescription_drugs = $prescription_drugs;

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
        $newMedicalNotes = null === $record ? null : $this;
        if ($record->getMedicalNotes() !== $newMedicalNotes) {
            $record->setMedicalNotes($newMedicalNotes);
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
