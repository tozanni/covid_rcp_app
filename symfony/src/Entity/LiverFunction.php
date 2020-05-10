<?php

namespace App\Entity;

use App\Repository\LiverFunctionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LiverFunctionRepository::class)
 */
class LiverFunction
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
    private $AspartateAminotransferase;

    /**
     * @ORM\Column(type="integer")
     */
    private $AlanineTransaminase;

    /**
     * @ORM\Column(type="integer")
     */
    private $BloodUreaNitrogen;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    /**
     * @ORM\OneToOne(targetEntity=Record::class, mappedBy="liverFunction", cascade={"persist", "remove"})
     */
    private $record;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAspartateAminotransferase(): ?int
    {
        return $this->AspartateAminotransferase;
    }

    public function setAspartateAminotransferase(int $AspartateAminotransferase): self
    {
        $this->AspartateAminotransferase = $AspartateAminotransferase;

        return $this;
    }

    public function getAlanineTransaminase(): ?int
    {
        return $this->AlanineTransaminase;
    }

    public function setAlanineTransaminase(int $AlanineTransaminase): self
    {
        $this->AlanineTransaminase = $AlanineTransaminase;

        return $this;
    }

    public function getBloodUreaNitrogen(): ?int
    {
        return $this->BloodUreaNitrogen;
    }

    public function setBloodUreaNitrogen(int $BloodUreaNitrogen): self
    {
        $this->BloodUreaNitrogen = $BloodUreaNitrogen;

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
        $newLiverFunction = null === $record ? null : $this;
        if ($record->getLiverFunction() !== $newLiverFunction) {
            $record->setLiverFunction($newLiverFunction);
        }

        return $this;
    }
}
