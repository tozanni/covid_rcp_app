<?php

namespace App\Entity;

use App\Repository\ClottingTimeRepository;
use Gedmo\Mapping\Annotation as Gedmo;
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
    private $prothrombin;

    /**
     * @ORM\Column(type="integer")
     */
    private $thromboplastin;

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
     * @ORM\OneToOne(targetEntity=Record::class, mappedBy="clottingTime", cascade={"persist", "remove"})
     */
    private $record;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProthrombin(): ?int
    {
        return $this->prothrombin;
    }

    public function setProthrombin(int $prothrombin): self
    {
        $this->prothrombin = $prothrombin;

        return $this;
    }

    public function getThromboplastin(): ?int
    {
        return $this->thromboplastin;
    }

    public function setThromboplastin(int $thromboplastin): self
    {
        $this->thromboplastin = $thromboplastin;

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
        $newClottingTime = null === $record ? null : $this;
        if ($record->getClottingTime() !== $newClottingTime) {
            $record->setClottingTime($newClottingTime);
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
