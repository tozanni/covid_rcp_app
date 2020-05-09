<?php

namespace App\Entity;

use App\Repository\RecordRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RecordRepository::class)
 */
class Record
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $admission_date;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $status;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $egress_date;

    /**
     * @ORM\Column(type="string", length=32, nullable=true)
     */
    private $egress_type;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $rcp_required;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $treatment;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $egress_notes;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getEgressDate(): ?\DateTimeInterface
    {
        return $this->egress_date;
    }

    public function setEgressDate(?\DateTimeInterface $egress_date): self
    {
        $this->egress_date = $egress_date;

        return $this;
    }

    public function getEgressType(): ?string
    {
        return $this->egress_type;
    }

    public function setEgressType(?string $egress_type): self
    {
        $this->egress_type = $egress_type;

        return $this;
    }

    public function getRcpRequired(): ?bool
    {
        return $this->rcp_required;
    }

    public function setRcpRequired(?bool $rcp_required): self
    {
        $this->rcp_required = $rcp_required;

        return $this;
    }

    public function getTreatment(): ?string
    {
        return $this->treatment;
    }

    public function setTreatment(?string $treatment): self
    {
        $this->treatment = $treatment;

        return $this;
    }

    public function getGressNotes(): ?string
    {
        return $this->gress_notes;
    }

    public function setGressNotes(?string $gress_notes): self
    {
        $this->gress_notes = $gress_notes;

        return $this;
    }

    public function getIngressDate(): ?\DateTimeInterface
    {
        return $this->ingress_date;
    }

    public function setIngressDate(\DateTimeInterface $ingress_date): self
    {
        $this->ingress_date = $ingress_date;

        return $this;
    }

    public function getAdmissionDate(): ?\DateTimeInterface
    {
        return $this->admission_date;
    }

    public function setAdmissionDate(\DateTimeInterface $admission_date): self
    {
        $this->admission_date = $admission_date;

        return $this;
    }

    public function getEgressNotes(): ?string
    {
        return $this->egress_notes;
    }

    public function setEgressNotes(?string $egress_notes): self
    {
        $this->egress_notes = $egress_notes;

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
}
