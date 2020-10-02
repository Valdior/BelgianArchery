<?php

namespace App\DataFixtures;

use App\Entity\Archer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArcherFixtures extends Fixture
{
    public const ARCHER_MP = "archer-mp";
    public const ARCHER_GC = "archer-gc";
    public const ARCHER_LP = "archer-lp";
    public const ARCHER_BA = "archer-ba";

    public function load(ObjectManager $manager)
    {
        $archer = new Archer();
        $archer->setLastname("Maréchal");
        $archer->setFirstname("Pierre");
        $archer->setStatus(Archer::ACTIVE);
        $manager->persist($archer);

        $this->addReference(self::ARCHER_MP, $archer);

        $archer = new Archer();
        $archer->setLastname("Gentille");
        $archer->setFirstname("Carmelo");
        $archer->setStatus(Archer::ACTIVE);
        $manager->persist($archer);

        $this->addReference(self::ARCHER_GC, $archer);

        $archer = new Archer();
        $archer->setLastname("Lorquet");
        $archer->setFirstname("Philippe");
        $archer->setStatus(Archer::ACTIVE);
        $manager->persist($archer);

        $this->addReference(self::ARCHER_LP, $archer);

        $archer = new Archer();
        $archer->setLastname("Bardoul");
        $archer->setFirstname("Andy");
        $archer->setStatus(Archer::ACTIVE);
        $manager->persist($archer);

        $this->addReference(self::ARCHER_BA, $archer);

        $manager->flush();
    }
}
