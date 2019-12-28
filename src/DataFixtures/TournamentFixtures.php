<?php

namespace App\DataFixtures;

use App\Entity\Tournament;
use App\DataFixtures\ClubFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class TournamentFixtures extends Fixture implements DependentFixtureInterface
{
    public const TOURN_ACG = "tourn-acg";
    public const TOURN_LIE = "toun-lie";
    public const TOURN_TEL = "toun-tel";
    public const TOURN_ITW = "toun-itw";
    public const TOURN_HUY = "toun-huy";
    public const TOURN_HAC = "toun-hac";
    public const TOURN_LFU = "toun-lfu";
    public const TOURN_PAC = "toun-pac";
    public const TOURN_GAU = "toun-gau";
    public const TOURN_ANT = "toun-ant";
    public const TOURN_ABA = "toun-aba";



    public function load(ObjectManager $manager)
    {
        $this->Saison20192020($manager);
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ClubFixtures::class,
        );
    }

    public function Saison20192020(ObjectManager $manager)
    {
        $tournament = new Tournament();
        $tournament->setStartDate(new \DateTime("01/11/2020"));
        $tournament->setEndDate(new \DateTime("01/12/2020"));
        $tournament->setType(Tournament::TYPE_INDOOR);
        $tournament->setOrganizer($this->getReference(ClubFixtures::CLUB_PAC));
        $manager->persist($tournament);

        $this->addReference(self::TOURN_PAC, $tournament);

        $tournament = new Tournament();
        $tournament->setStartDate(new \DateTime("01/11/2020"));
        $tournament->setEndDate(new \DateTime("01/12/2020"));
        $tournament->setType(Tournament::TYPE_INDOOR);
        $tournament->setOrganizer($this->getReference(ClubFixtures::CLUB_ACG));
        $manager->persist($tournament);

        $this->addReference(self::TOURN_ACG, $tournament);

        $tournament = new Tournament();
        $tournament->setStartDate(new \DateTime("01/12/2020"));
        $tournament->setEndDate(new \DateTime("01/12/2020"));
        $tournament->setType(Tournament::TYPE_INDOOR);
        $tournament->setOrganizer($this->getReference(ClubFixtures::CLUB_GAU));
        $manager->persist($tournament);

        $this->addReference(self::TOURN_GAU, $tournament);

        $tournament = new Tournament();
        $tournament->setStartDate(new \DateTime("01/18/2020"));
        $tournament->setEndDate(new \DateTime("01/19/2020"));
        $tournament->setType(Tournament::TYPE_INDOOR);
        $tournament->setOrganizer($this->getReference(ClubFixtures::CLUB_ANT));
        $manager->persist($tournament);

        $this->addReference(self::TOURN_ANT, $tournament);

        $tournament = new Tournament();
        $tournament->setStartDate(new \DateTime("01/19/2020"));
        $tournament->setEndDate(new \DateTime("01/19/2020"));
        $tournament->setType(Tournament::TYPE_INDOOR);
        $tournament->setOrganizer($this->getReference(ClubFixtures::CLUB_ITW));
        $manager->persist($tournament);

        $this->addReference(self::TOURN_ITW, $tournament);

        $tournament = new Tournament();
        $tournament->setStartDate(new \DateTime("01/25/2020"));
        $tournament->setEndDate(new \DateTime("01/26/2020"));
        $tournament->setType(Tournament::TYPE_INDOOR);
        $tournament->setOrganizer($this->getReference(ClubFixtures::CLUB_ABA));
        $manager->persist($tournament);

        $this->addReference(self::TOURN_ABA, $tournament);

        $tournament = new Tournament();
        $tournament->setStartDate(new \DateTime("02/29/2020"));
        $tournament->setEndDate(new \DateTime("03/01/2020"));
        $tournament->setType(Tournament::TYPE_INDOOR);
        $tournament->setOrganizer($this->getReference(ClubFixtures::CLUB_LIE));
        $manager->persist($tournament);

        $this->addReference(self::TOURN_TEL, $tournament);

        $tournament = new Tournament();
        $tournament->setStartDate(new \DateTime("03/07/2020"));
        $tournament->setEndDate(new \DateTime("03/08/2020"));
        $tournament->setType(Tournament::TYPE_INDOOR);
        $tournament->setOrganizer($this->getReference(ClubFixtures::CLUB_HUY));
        $manager->persist($tournament);

        $this->addReference(self::TOURN_HUY, $tournament);

        $tournament = new Tournament();
        $tournament->setStartDate(new \DateTime("03/14/2020"));
        $tournament->setEndDate(new \DateTime("03/15/2020"));
        $tournament->setType(Tournament::TYPE_INDOOR);
        $tournament->setOrganizer($this->getReference(ClubFixtures::CLUB_HAC));
        $manager->persist($tournament);

        $this->addReference(self::TOURN_HAC, $tournament);

        $tournament = new Tournament();
        $tournament->setStartDate(new \DateTime("03/28/2020"));
        $tournament->setEndDate(new \DateTime("03/29/2020"));
        $tournament->setType(Tournament::TYPE_INDOOR);
        $tournament->setOrganizer($this->getReference(ClubFixtures::CLUB_LFU));
        $manager->persist($tournament);

        $this->addReference(self::TOURN_LFU, $tournament);
    }
}
