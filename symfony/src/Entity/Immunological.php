<?php

namespace App\Entity;

use App\Repository\ImmunologicalRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImmunologicalRepository::class)
 */
class Immunological
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
    private $ReactiveProteinC;

    /**
     * @ORM\OneToOne(targetEntity=Record::class, mappedBy="Immunological", cascade={"persist", "remove"})
     */
    private $record;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReactiveProteinC(): ?int
    {
        return $this->ReactiveProteinC;
    }

    public function setReactiveProteinC(int $ReactiveProteinC): self
    {
        $this->ReactiveProteinC = $ReactiveProteinC;

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
        $newImmunological = null === $record ? null : $this;
        if ($record->getImmunological() !== $newImmunological) {
            $record->setImmunological($newImmunological);
        }

        return $this;
    }
}
