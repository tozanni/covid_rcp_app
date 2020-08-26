<?php

namespace App\Entity;

use App\Repository\CovidRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass=CovidRepository::class)
 * @Serializer\ExclusionPolicy("all")
 * @Gedmo\Loggable()
 */
class Covid
{
    use EntityTrait;
    use TimestampableTrait;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Serializer\Expose()
     * @Gedmo\Versioned()
     */
    private $pcr;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Serializer\Expose()
     * @Gedmo\Versioned()
     */
    private $ldh;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Serializer\Expose()
     * @Gedmo\Versioned()
     */
    private $il_6;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Serializer\Expose()
     * @Gedmo\Versioned()
     */
    private $ferritin;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Serializer\Expose()
     * @Gedmo\Versioned()
     */
    private $troponin;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Serializer\Expose()
     * @Gedmo\Versioned()
     */
    private $igm;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Serializer\Expose()
     * @Gedmo\Versioned()
     */
    private $igg;

    /**
     * @ORM\OneToOne(targetEntity=Record::class, mappedBy="covid", cascade={"persist", "remove"})
     */
    private $record;

    public function getPcr(): ?bool
    {
        return $this->pcr;
    }

    public function setPcr(?bool $pcr): self
    {
        $this->pcr = $pcr;

        return $this;
    }

    public function getLdh(): ?float
    {
        return $this->ldh;
    }

    public function setLdh(?float $ldh): self
    {
        $this->ldh = $ldh;

        return $this;
    }

    public function getIl6(): ?float
    {
        return $this->il_6;
    }

    public function setIl6(?float $il_6): self
    {
        $this->il_6 = $il_6;

        return $this;
    }

    public function getFerritin(): ?float
    {
        return $this->ferritin;
    }

    public function setFerritin(?float $ferritin): self
    {
        $this->ferritin = $ferritin;

        return $this;
    }

    public function getTroponin(): ?float
    {
        return $this->troponin;
    }

    public function setTroponin(?float $troponin): self
    {
        $this->troponin = $troponin;

        return $this;
    }

    public function getIgm(): ?float
    {
        return $this->igm;
    }

    public function setIgm(?float $igm): self
    {
        $this->igm = $igm;

        return $this;
    }

    public function getIgg(): ?float
    {
        return $this->igg;
    }

    public function setIgg(?float $igg): self
    {
        $this->igg = $igg;

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
        $newCovid = null === $record ? null : $this;
        if ($record->getCovid() !== $newCovid) {
            $record->setCovid($newCovid);
        }

        return $this;
    }

}
