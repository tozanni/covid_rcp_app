<?php

namespace App\Entity;

use App\Repository\RecordRepository;
use Gedmo\Mapping\Annotation as Gedmo;
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $id_canonical;

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
     * @ORM\OneToOne(targetEntity=VitalSigns::class, inversedBy="record", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $vitalSigns;

    /**
     * @ORM\OneToOne(targetEntity=Triage::class, inversedBy="record", cascade={"persist", "remove"})
     */
    private $triage;

    /**
     * @ORM\OneToOne(targetEntity=HematicBiometry::class, inversedBy="record", cascade={"persist", "remove"})
     */
    private $hematicBiometry;

    /**
     * @ORM\OneToOne(targetEntity=BloodChemistry::class, inversedBy="record", cascade={"persist", "remove"})
     */
    private $bloodChemistry;

    /**
     * @ORM\OneToOne(targetEntity=SerumElectrolytes::class, inversedBy="record", cascade={"persist", "remove"})
     */
    private $serumElectrolytes;

    /**
     * @ORM\OneToOne(targetEntity=MedicalNotes::class, inversedBy="record", cascade={"persist", "remove"})
     */
    private $medicalNotes;

    /**
     * @ORM\OneToOne(targetEntity=LiverFunction::class, inversedBy="record", cascade={"persist", "remove"})
     */
    private $liverFunction;

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
     * @ORM\OneToOne(targetEntity=ClottingTime::class, inversedBy="record", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $ClottingTime;

    /**
     * @ORM\OneToOne(targetEntity=Immunological::class, inversedBy="record", cascade={"persist", "remove"})
     */
    private $Immunological;

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

    public function getVitalSigns(): ?VitalSigns
    {
        return $this->vitalSigns;
    }

    public function setVitalSigns(VitalSigns $vitalSigns): self
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
        return $this->ClottingTime;
    }

    public function setClottingTime(ClottingTime $ClottingTime): self
    {
        $this->ClottingTime = $ClottingTime;

        return $this;
    }

    public function getImmunological(): ?Immunological
    {
        return $this->Immunological;
    }

    public function setImmunological(?Immunological $Immunological): self
    {
        $this->Immunological = $Immunological;

        return $this;
    }
}
