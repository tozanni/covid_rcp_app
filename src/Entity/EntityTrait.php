<?php
/**
 * @author Enrique García <enrique@inodata.mx>
 * Date: 25/06/20 Time: 20:18
 */
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
//use Ramsey\Uuid\UuidInterface;
//use Ramsey\Uuid\Doctrine\UuidGenerator;

trait EntityTrait
{
    /**
    * @ORM\Id()
    * @ORM\GeneratedValue()
    * @ORM\Column(type="integer")
    */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}