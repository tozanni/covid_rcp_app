<?php

namespace App\Entity;

use App\Repository\ArterialBloodGasRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use App\Entity\Loggable\ArterialBloodGas as LogEntity;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass=ArterialBloodGasRepository::class)
 * @Serializer\ExclusionPolicy("all")
 * @Gedmo\Loggable(logEntryClass=LogEntity::class)
 */
class ArterialBloodGas
{
    use EntityTrait;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Gedmo\Versioned
     * @Serializer\Expose()
     */
    private $ph;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Gedmo\Versioned
     * @Serializer\Expose()
     */
    private $o2;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Gedmo\Versioned
     * @Serializer\Expose()
     */
    private $co2;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Gedmo\Versioned
     * @Serializer\Expose()
     */
    private $hco3;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Gedmo\Versioned
     * @Serializer\Expose()
     */
    private $be;

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
     * @ORM\OneToOne(targetEntity=Record::class, mappedBy="arterialBloodGas", cascade={"persist", "remove"})
     */
    private $record;

    public function __toString()
    {
        return (string) $this->id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPh(): ?float
    {
        return $this->ph;
    }

    public function setPh(?float $ph): self
    {
        $this->ph = $ph;

        return $this;
    }

    public function getO2(): ?float
    {
        return $this->o2;
    }

    public function setO2(?float $o2): self
    {
        $this->o2 = $o2;

        return $this;
    }

    public function getHco3(): ?float
    {
        return $this->hco3;
    }

    public function setHco3(?float $hco3): self
    {
        $this->hco3 = $hco3;

        return $this;
    }

    public function getBe(): ?float
    {
        return $this->be;
    }

    public function setBe(?float $be): self
    {
        $this->be = $be;

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

    public function getRecord(): ?Record
    {
        return $this->record;
    }

    public function setRecord(?Record $record): self
    {
        $this->record = $record;

        // set (or unset) the owning side of the relation if necessary
        $newArterialBloodGas = null === $record ? null : $this;
        if ($record->getArterialBloodGas() !== $newArterialBloodGas) {
            $record->setArterialBloodGas($newArterialBloodGas);
        }

        return $this;
    }

    public function getCo2(): ?float
    {
        return $this->co2;
    }

    public function setCo2(?float $co2): self
    {
        $this->co2 = $co2;

        return $this;
    }
}
