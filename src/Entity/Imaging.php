<?php

namespace App\Entity;

use App\Repository\ImagingRepository;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ImagingRepository::class)
 * @Serializer\ExclusionPolicy("all")
 */
class Imaging
{
    use EntityTrait;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $radiography;

    /**
     * @ORM\Column(type="string", length=128)
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $result;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime_immutable")
     */
    private $created_at;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $updated_at;

    /**
     * @ORM\OneToOne(targetEntity=Record::class, mappedBy="imaging", cascade={"persist", "remove"})
     */
    private $record;

    public function getResult(): ?string
    {
        return $this->result;
    }

    public function setResult(string $result): self
    {
        $this->result = $result;

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

    public function setUpdatedAt(?\DateTimeImmutable $updated_at): self
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
        $newImaging = null === $record ? null : $this;
        if ($record->getImaging() !== $newImaging) {
            $record->setImaging($newImaging);
        }

        return $this;
    }

    public function getRadiography(): ?bool
    {
        return $this->radiography;
    }

    public function setRadiography(bool $radiography): self
    {
        $this->radiography = $radiography;

        return $this;
    }
}
