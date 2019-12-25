<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    public const USER_ADMIN = "user-admin";
    public const USER_ARCHER = "user-archer";
    public const USER_USER = "user-user";
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername("admin");
        $user->setEmail("valdior@outlook.com");
        $password = $this->encoder->encodePassword($user, 'admin');
        $user->setPassword($password);
        $user->setArcher($this->getReference(ArcherFixtures::ARCHER_MP));
        $user->addRole("ROLE_ADMIN");

        $manager->persist($user);

        $this->addReference(self::USER_ADMIN, $user);

        $user = new User();
        $user->setUsername("archer");
        $user->setEmail("archer@user.com");
        $password = $this->encoder->encodePassword($user, 'archer');
        $user->setPassword($password);
        $user->setArcher($this->getReference(ArcherFixtures::ARCHER_GC));
        $user->addRole("ROLE_ARCHER");

        $manager->persist($user);

        $this->addReference(self::USER_ARCHER, $user);

        $user = new User();
        $user->setUsername("user");
        $user->setEmail("user@user.com");
        $password = $this->encoder->encodePassword($user, 'user');
        $user->setPassword($password);

        $manager->persist($user);

        $this->addReference(self::USER_USER, $user);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ArcherFixtures::class,
        );
    }
}
