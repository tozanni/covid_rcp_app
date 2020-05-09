<?php

namespace App\Entity;

use App\Repository\HematicBiometryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HematicBiometryRepository::class)
 */
class HematicBiometry
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
    private $hematocrit;

    /**
     * @ORM\Column(type="integer")
     */
    private $hemoglobin;

    /**
     * @ORM\Column(type="integer")
     */
    private $leukocytes;

    /**
     * @ORM\Column(type="integer")
     */
    private $platelets;

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

    public function getHematocrit(): ?int
    {
        return $this->hematocrit;
    }

    public function setHematocrit(int $hematocrit): self
    {
        $this->hematocrit = $hematocrit;

        return $this;
    }

    public function getHemoglobin(): ?int
    {
        return $this->hemoglobin;
    }

    public function setHemoglobin(int $hemoglobin): self
    {
        $this->hemoglobin = $hemoglobin;

        return $this;
    }

    public function getLeukocytes(): ?int
    {
        return $this->leukocytes;
    }

    public function setLeukocytes(int $leukocytes): self
    {
        $this->leukocytes = $leukocytes;

        return $this;
    }

    public function getPlatelets(): ?int
    {
        return $this->platelets;
    }

    public function setPlatelets(int $platelets): self
    {
        $this->platelets = $platelets;

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
