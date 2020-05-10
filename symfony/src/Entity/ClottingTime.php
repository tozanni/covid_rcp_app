<?php

namespace App\Entity;

use App\Repository\ClottingTimeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClottingTimeRepository::class)
 */
class ClottingTime
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
    private $Prothrombin;

    /**
     * @ORM\Column(type="integer")
     */
    private $Thromboplastin;

    /**
     * @ORM\OneToOne(targetEntity=Record::class, mappedBy="ClottingTime", cascade={"persist", "remove"})
     */
    private $record;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProthrombin(): ?int
    {
        return $this->Prothrombin;
    }

    public function setProthrombin(int $Prothrombin): self
    {
        $this->Prothrombin = $Prothrombin;

        return $this;
    }

    public function getThromboplastin(): ?int
    {
        return $this->Thromboplastin;
    }

    public function setThromboplastin(int $Thromboplastin): self
    {
        $this->Thromboplastin = $Thromboplastin;

        return $this;
    }

    public function getRecord(): ?Record
    {
        return $this->record;
    }

    public function setRecord(Record $record): self
    {
        $this->record = $record;

        // set the owning side of the relation if necessary
        if ($record->getClottingTime() !== $this) {
            $record->setClottingTime($this);
        }

        return $this;
    }
}
