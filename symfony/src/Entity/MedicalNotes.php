<?php

namespace App\Entity;

use App\Repository\MedicalNotesRepository;
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
}
