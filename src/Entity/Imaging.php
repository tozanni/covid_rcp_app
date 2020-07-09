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
    private $chest_x_ray;

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
     * @ORM\OneToOne(targetEntity=Record::class, mappedBy="immunological", cascade={"persist", "remove"})
     */
    private $record;

    public function getChestXRay(): ?bool
    {
        return $this->chest_x_ray;
    }

    public function setChestXRay(bool $chest_x_ray): self
    {
        $this->chest_x_ray = $chest_x_ray;

        return $this;
    }

    public function getResult(): ?string
    {
        return $this->result;
    }

    public function setResult(string $result): self
    {
        $this->result = $result;

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

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
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
        $newImmunological = null === $record ? null : $this;
        if ($record->getImmunological() !== $newImmunological) {
            $record->setImmunological($newImmunological);
        }

        return $this;
    }
}
