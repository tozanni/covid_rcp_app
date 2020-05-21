<?php

namespace App\DataFixtures;

use App\Application\Sonata\UserBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
            $user = new User();
            $user->setUsername('admin');
            $user->setEmail('admin@example.com');
            $user->setEnabled(true);

            $password = $this->encoder->encodePassword($user, 'covidadmin2020');
            $user->setPassword($password);

            $manager->persist($user);
            $manager->flush();
    }
}
