<?php
/**
 * @author Enrique García <enrique@inodata.mx>
 * Date: 25/06/20 Time: 20:18
 */
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;

trait EntityTrait
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     */
    private $id;

    public function getId()
    {
        return $this->id;
    }
}