<?php

namespace App\Entity;

use App\Repository\LiverFunctionRepository;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=LiverFunctionRepository::class)
 * @Serializer\ExclusionPolicy("all")
 */
class LiverFunction
{
    use EntityTrait;

    /**
     * @ORM\Column(type="float")
     *@Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $aspartateAminotransferase;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $alanineTransaminase;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $bloodUreaNitrogen;

    /**
     * @ORM\OneToOne(targetEntity=Record::class, mappedBy="liverFunction", cascade={"persist", "remove"})
     */
    private $record;

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

    public function getAspartateAminotransferase(): ?float
    {
        return $this->aspartateAminotransferase;
    }

    public function setAspartateAminotransferase(float $aspartateAminotransferase): self
    {
        $this->aspartateAminotransferase = $aspartateAminotransferase;

        return $this;
    }

    public function getAlanineTransaminase(): ?float
    {
        return $this->alanineTransaminase;
    }

    public function setAlanineTransaminase(float $alanineTransaminase): self
    {
        $this->alanineTransaminase = $alanineTransaminase;

        return $this;
    }

    public function getBloodUreaNitrogen(): ?float
    {
        return $this->bloodUreaNitrogen;
    }

    public function setBloodUreaNitrogen(float $bloodUreaNitrogen): self
    {
        $this->bloodUreaNitrogen = $bloodUreaNitrogen;

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
        $newLiverFunction = null === $record ? null : $this;
        if ($record->getLiverFunction() !== $newLiverFunction) {
            $record->setLiverFunction($newLiverFunction);
        }

        return $this;
    }
}
