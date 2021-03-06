<?php

namespace App\Entity;

use App\Repository\ImmunologicalRepository;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use App\Entity\Loggable\Immunological as LogEntity;

/**
 * @ORM\Entity(repositoryClass=ImmunologicalRepository::class)
 * @Serializer\ExclusionPolicy("all")
 * @Gedmo\Loggable(logEntryClass=LogEntity::class)
 */
class Immunological
{
    use EntityTrait;

    /**
     * @Gedmo\Versioned
     * @ORM\Column(type="float", nullable=true)
     * @Serializer\Expose()
     */
    private $reactiveProteinC;

    /**
     * @Gedmo\Versioned
     * @ORM\Column(type="float", nullable=true)
     * @Serializer\Expose()
     */
    private $procalcitonin;

    /**
     * @Gedmo\Versioned
     * @ORM\Column(type="float", nullable=true)
     * @Serializer\Expose()
     */
    private $dDimer;

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
     * @ORM\OneToOne(targetEntity=Record::class, mappedBy="immunological", cascade={"persist", "remove"})
     */
    private $record;

    public function __toString()
    {
        return (string) $this->id;
    }

    public function getReactiveProteinC(): ?float
    {
        return $this->reactiveProteinC;
    }

    public function setReactiveProteinC(?float $reactiveProteinC): self
    {
        $this->reactiveProteinC = $reactiveProteinC;

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

    public function getProcalcitonin(): ?float
    {
        return $this->procalcitonin;
    }

    public function setProcalcitonin(?float $procalcitonin): self
    {
        $this->procalcitonin = $procalcitonin;

        return $this;
    }

    public function getDDimer(): ?float
    {
        return $this->dDimer;
    }

    public function setDDimer(?float $dDimer): self
    {
        $this->dDimer = $dDimer;

        return $this;
    }
}
