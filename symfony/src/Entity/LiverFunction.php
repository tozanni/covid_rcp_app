<?php

namespace App\Entity;

use App\Repository\LiverFunctionRepository;
use Gedmo\Mapping\Annotation as Gedmo;
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
    private $aspartateAminotransferase;

    /**
     * @ORM\Column(type="integer")
     */
    private $alanineTransaminase;

    /**
     * @ORM\Column(type="integer")
     */
    private $bloodUreaNitrogen;

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
     * @ORM\OneToOne(targetEntity=Record::class, mappedBy="liverFunction", cascade={"persist", "remove"})
     */
    private $record;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAspartateAminotransferase(): ?int
    {
        return $this->aspartateAminotransferase;
    }

    public function setAspartateAminotransferase(int $aspartateAminotransferase): self
    {
        $this->aspartateAminotransferase = $aspartateAminotransferase;

        return $this;
    }

    public function getAlanineTransaminase(): ?int
    {
        return $this->alanineTransaminase;
    }

    public function setAlanineTransaminase(int $alanineTransaminase): self
    {
        $this->alanineTransaminase = $alanineTransaminase;

        return $this;
    }

    public function getBloodUreaNitrogen(): ?int
    {
        return $this->bloodUreaNitrogen;
    }

    public function setBloodUreaNitrogen(int $bloodUreaNitrogen): self
    {
        $this->bloodUreaNitrogen = $bloodUreaNitrogen;

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
