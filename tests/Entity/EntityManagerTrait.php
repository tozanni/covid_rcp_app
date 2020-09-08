<?php

namespace App\Tests\Entity;

/**
 * @author Enrique García <enrique@inodata.mx>
 * Date: 08/09/20 Time: 0:27
 */
trait EntityManagerTrait
{
    private $entityManager;

    public function setUp()
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function tearDown()
    {
        parent::tearDown();
        $this->entityManager->close();
        $this->entityManager = null;
    }
}