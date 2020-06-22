<?php

namespace App\Entity;

use App\Repository\SerumElectrolytesRepository;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SerumElectrolytesRepository::class)
 */
class SerumElectrolytes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal")
     */
    private $sodium;

    /**
     * @ORM\Column(type="decimal")
     */
    private $potassium;

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
     * @ORM\OneToOne(targetEntity=Record::class, mappedBy="serumElectrolytes", cascade={"persist", "remove"})
     */
    private $record;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSodium(): ?string
    {
        return $this->sodium;
    }

    public function setSodium(string $sodium): self
    {
        $this->sodium = $sodium;

        return $this;
    }

    public function getPotassium(): ?string
    {
        return $this->potassium;
    }

    public function setPotassium(string $potassium): self
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
