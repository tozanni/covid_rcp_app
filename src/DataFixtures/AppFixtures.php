<?php

namespace App\DataFixtures;

use App\Application\Sonata\UserBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
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
            $admin = new User();
            $admin->setUsername('admin');
            $admin->setEmail('admin@example.com');
            $admin->setRoles(['ROLE_SUPER_ADMIN']);
            $admin->setEnabled(true);
            $password = $this->encoder->encodePassword($admin, 'covidadmin2020');
            $admin->setPassword($password);

            $user = new User();
            $user->setUsername('anonymous');
            $user->setEmail('anonymous@example.com');
            $user->setRoles(['ROLE_USER']);
            $user->setEnabled(true);
            $password = $this->encoder->encodePassword($user, 'anonymous2020');
            $user->setPassword($password);

            $manager->persist($admin);
            $manager->persist($user);
            $manager->flush();
    }
}
