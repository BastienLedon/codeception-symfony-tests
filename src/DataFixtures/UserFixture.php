<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('john_doe@gmail.com');
        $user->setPassword(
            $this->encoder->encodePassword($user, '123456')
        );
        $manager->persist($user);
        $manager->flush();

        $user = new User();
        $user->setEmail('john_doe1@gmail.com');
        $user->setPassword(
            $this->encoder->encodePassword($user, '123456')
        );
        $manager->persist($user);
        $manager->flush();
    }
}
