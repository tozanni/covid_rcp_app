<?php

namespace App\Entity;

use App\Repository\CovidRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass=CovidRepository::class)
 * @Serializer\ExclusionPolicy("all")
 */
class Covid
{
    use EntityTrait;
    use TimestampableTrait;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Serializer\Expose()
     */
    private $pcr;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Serializer\Expose()
     */
    private $ldh;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Serializer\Expose()
     */
    private $il_6;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Serializer\Expose()
     */
    private $ferritin;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Serializer\Expose()
     */
    private $troponin;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Serializer\Expose()
     */
    private $igm;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Serializer\Expose()
     */
    private $igg;

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

}
