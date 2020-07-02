<?php

namespace App\Entity;

use App\Repository\SerumElectrolytesRepository;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=SerumElectrolytesRepository::class)
 * @Serializer\ExclusionPolicy("all")
 */
class SerumElectrolytes
{
    use EntityTrait;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $sodium;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $potassium;

    /**
     * @ORM\OneToOne(targetEntity=Record::class, mappedBy="serumElectrolytes", cascade={"persist", "remove"})
     */
    private $record;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime_immutable")
     * @Serializer\Expose()
     */
    private $created_at;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime_immutable")
     * @Serializer\Expose()
     */
    private $updated_at;

    public function getSodium(): ?float
    {
        return $this->sodium;
    }

    public function setSodium(float $sodium): self
    {
        $this->sodium = $sodium;

        return $this;
    }

    public function getPotassium(): ?float
    {
        return $this->potassium;
    }

    public function setPotassium(float $potassium): self
    {
        $this->potassium = $potassium;

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

    public function getRecord(): ?Record
    {
        return $this->record;
    }

    public function setRecord(?Record $record): self
    {
        $this->record = $record;

        // set (or unset) the owning side of the relation if necessary
        $newSerumElectrolytes = null === $record ? null : $this;
        if ($record->getSerumElectrolytes() !== $newSerumElectrolytes) {
            $record->setSerumElectrolytes($newSerumElectrolytes);
        }

        return $this;
    }
}
