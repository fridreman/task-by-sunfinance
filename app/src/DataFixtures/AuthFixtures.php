<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AuthFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $hasher
    ) {}

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setUsername("johndoe");
        $user->setEmail("johndoe@example.com");
        $user->setPassword($this->hasher->hashPassword($user, 'apassword'));

        $manager->persist($user);
        $manager->flush();
    }
}
