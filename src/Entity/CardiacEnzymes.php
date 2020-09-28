<?php

namespace App\Entity;

use App\Repository\CardiacEnzymesRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use App\Entity\Loggable\CardiacEnzymes as LogEntity;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass=CardiacEnzymesRepository::class)
 * @Serializer\ExclusionPolicy("all")
 * @Gedmo\Loggable(logEntryClass=LogEntity::class)
 */
class CardiacEnzymes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Gedmo\Versioned
     * @ORM\Column(type="float", nullable=true)
     */
    private $cpk;

    /**
     * @Gedmo\Versioned
     * @ORM\Column(type="float", nullable=true)
     */
    private $miogoblin;

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
     * @ORM\OneToOne(targetEntity=Record::class, mappedBy="cardiacEnzymes", cascade={"persist", "remove"})
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

    public function getCpk(): ?float
    {
        return $this->cpk;
    }

    public function setCpk(?float $cpk): self
    {
        $this->cpk = $cpk;

        return $this;
    }

    public function getMiogoblin(): ?float
    {
        return $this->miogoblin;
    }

    public function setMiogoblin(?float $miogoblin): self
    {
        $this->miogoblin = $miogoblin;

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
        $newCardiacEnzymes = null === $record ? null : $this;
        if ($record->getCardiacEnzymes() !== $newCardiacEnzymes) {
            $record->setCardiacEnzymes($newCardiacEnzymes);
        }

        return $this;
    }
}
