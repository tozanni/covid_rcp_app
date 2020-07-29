<?php

namespace App\Entity;

use App\Repository\RecordRepository;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=RecordRepository::class)
 * @Serializer\ExclusionPolicy("all")
 */
class Record
{
    use EntityTrait;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $admission_date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Serializer\Expose()
     */
    private $id_canonical;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    private $status;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Serializer\Expose()
     */
    private $egress_date;

    /**
     * @ORM\Column(type="string", length=32, nullable=true)
     * @Serializer\Expose()
     */
    private $egress_type;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Serializer\Expose()
     */
    private $rcp_required;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Serializer\Expose()
     */
    private $treatment;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Serializer\Expose()
     */
    private $egress_notes;

    /**
     * @ORM\OneToOne(targetEntity=VitalSigns::class, inversedBy="record",
     *     cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     * @Serializer\Expose()
     */
    private $vitalSigns;

    /**
     * @ORM\OneToOne(targetEntity=Triage::class, inversedBy="record",
     *     cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     * @Serializer\Expose()
     */
    private $triage;

    /**
     * @ORM\OneToOne(targetEntity=HematicBiometry::class, inversedBy="record",
     *     cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     * @Serializer\Expose()
     */
    private $hematicBiometry;

    /**
     * @ORM\OneToOne(targetEntity=BloodChemistry::class, inversedBy="record",
     *     cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     * @Serializer\Expose()
     */
    private $bloodChemistry;

    /**
     * @ORM\OneToOne(targetEntity=SerumElectrolytes::class, inversedBy="record",
     *     cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     * @Serializer\Expose()
     */
    private $serumElectrolytes;

    /**
     * @ORM\OneToOne(targetEntity=MedicalNotes::class, inversedBy="record",
     *     cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     * @Serializer\Expose()
     */
    private $medicalNotes;

    /**
     * @ORM\OneToOne(targetEntity=LiverFunction::class, inversedBy="record",
     *     cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     * @Serializer\Expose()
     */
    private $liverFunction;

    /**
     * @ORM\OneToOne(targetEntity=ClottingTime::class, inversedBy="record", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     * @Serializer\Expose()
     */
    private $clottingTime;

    /**
     * @ORM\OneToOne(targetEntity=Immunological::class, inversedBy="record",
     *     cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     * @Serializer\Expose()
     */
    private $immunological;

    /**
     * @ORM\OneToOne(targetEntity=Imaging::class, inversedBy="record",
     *     cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     * @Serializer\Expose()
     */
    private $imaging;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     * @Serializer\Expose()
     */
    private $created_at;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     * @Serializer\Expose()
     */
    private $updated_at;

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
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

    public function getVitalSigns(): ?VitalSigns
    {
        return $this->vitalSigns;
    }

    public function setVitalSigns(?VitalSigns $vitalSigns): self
    {
        $this->vitalSigns = $vitalSigns;

        return $this;
    }

    public function getTriage(): ?Triage
    {
        return $this->triage;
    }

    public function setTriage(?Triage $triage): self
    {
        $this->triage = $triage;

        return $this;
    }

    public function getIdCanonical(): ?string
    {
        return $this->id_canonical;
    }

    public function setIdCanonical(?string $id_canonical): self
    {
        $this->id_canonical = $id_canonical;

        return $this;
    }

    public function getHematicBiometry(): ?HematicBiometry
    {
        return $this->hematicBiometry;
    }

    public function setHematicBiometry(?HematicBiometry $hematicBiometry): self
    {
        $this->hematicBiometry = $hematicBiometry;

        return $this;
    }

    public function getBloodChemistry(): ?BloodChemistry
    {
        return $this->bloodChemistry;
    }

    public function setBloodChemistry(?BloodChemistry $bloodChemistry): self
    {
        $this->bloodChemistry = $bloodChemistry;

        return $this;
    }

    public function getSerumElectrolytes(): ?SerumElectrolytes
    {
        return $this->serumElectrolytes;
    }

    public function setSerumElectrolytes(?SerumElectrolytes $serumElectrolytes): self
    {
        $this->serumElectrolytes = $serumElectrolytes;

        return $this;
    }

    public function getMedicalNotes(): ?MedicalNotes
    {
        return $this->medicalNotes;
    }

    public function setMedicalNotes(?MedicalNotes $medicalNotes): self
    {
        $this->medicalNotes = $medicalNotes;

        return $this;
    }

    public function getLiverFunction(): ?LiverFunction
    {
        return $this->liverFunction;
    }

    public function setLiverFunction(?LiverFunction $liverFunction): self
    {
        $this->liverFunction = $liverFunction;

        return $this;
    }

    public function getClottingTime(): ?ClottingTime
    {
        return $this->clottingTime;
    }

    public function setClottingTime(?ClottingTime $clottingTime): self
    {
        $this->clottingTime = $clottingTime;

        return $this;
    }

    public function getImmunological(): ?Immunological
    {
        return $this->immunological;
    }

    public function setImmunological(?Immunological $immunological): self
    {
        $this->immunological = $immunological;

        return $this;
    }

    public function getImaging(): ?Imaging
    {
        return $this->imaging;
    }

    public function setImaging(?Imaging $imaging): self
    {
        $this->imaging = $imaging;

        return $this;
    }
}
