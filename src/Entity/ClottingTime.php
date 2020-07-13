<?php

namespace App\Entity;

use App\Repository\ClottingTimeRepository;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass=ClottingTimeRepository::class)
 * @Serializer\ExclusionPolicy("all")
 */
class ClottingTime
{
    use EntityTrait;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Serializer\Expose()
     */
    private $prothrombin;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Serializer\Expose()
     */
    private $thromboplastin;

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
     * @ORM\OneToOne(targetEntity=Record::class, mappedBy="clottingTime", cascade={"persist", "remove"})
     */
    private $record;

    public function getProthrombin(): ?float
    {
        return $this->prothrombin;
    }

    public function setProthrombin(?float $prothrombin): self
    {
        $this->prothrombin = $prothrombin;

        return $this;
    }

    public function getThromboplastin(): ?float
    {
        return $this->thromboplastin;
    }

    public function setThromboplastin(?float $thromboplastin): self
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
