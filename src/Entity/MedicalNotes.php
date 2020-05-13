<?php

namespace App\Entity;

use App\Repository\MedicalNotesRepository;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MedicalNotesRepository::class)
 */
class MedicalNotes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $notes;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $prescription_drugs;

    /**
     * @ORM\OneToOne(targetEntity=Record::class, mappedBy="medicalNotes", cascade={"persist", "remove"})
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

    public function getId(): ?int
    {
        return $this->id;
    }

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
