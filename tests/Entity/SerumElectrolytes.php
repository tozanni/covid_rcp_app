<?php

namespace App\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * @author Enrique García <enrique@inodata.mx>
 * Date: 07/09/20 Time: 22:55
 */
class SerumElectrolytes extends KernelTestCase
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

    /** @test */
    public function History()
    {
        $serumElectrolytes = new \App\Entity\SerumElectrolytes();
        $serumElectrolytes->setSodium(1.2);
        $serumElectrolytes->setPotassium(1.3);
        $this->entityManager->persist($serumElectrolytes);
        $this->entityManager->flush();

        $this->assertEquals(1.2, $serumElectrolytes->getSodium());

        $serumElectrolytes->setSodium(1.5);
        $this->entityManager->flush();

        $this->assertEquals(1.5, $serumElectrolytes->getSodium());
        $this->assertIsArray($serumElectrolytes->getSodiumHistory());

    }


}