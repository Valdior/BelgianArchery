<?php

namespace App\DataFixtures;

use App\Entity\Tournament;
use App\DataFixtures\ClubFixtures;
use App\DataFixtures\LocationFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class TournamentFixtures extends Fixture implements DependentFixtureInterface
{
    public const TOURN_ACG = "tourn-acg";
    public const TOURN_LIE = "tourn-lie";
    public const TOURN_TEL = "tourn-tel";
    public const TOURN_ITW = "tourn-itw";
    public const TOURN_HUY = "tourn-huy";
    public const TOURN_HAC = "tourn-hac";
    public const TOURN_LFU = "tourn-lfu";
    public const TOURN_PAC = "tourn-pac";
    public const TOURN_GAU = "tourn-gau";
    public const TOURN_ANT = "tourn-ant";
    public const TOURN_ABA = "tourn-aba";

    public function load(ObjectManager $manager)
    {
        $this->Saison2020($manager);
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ClubFixtures::class,
            LocationFixtures::class
        );
    }

    public function Saison2020(ObjectManager $manager)
    {
        $tournament = new Tournament();
        $tournament->setStartDate(new \DateTime("05/16/2020"));
        $tournament->setEndDate(new \DateTime("05/17/2020"));
        $tournament->setType(Tournament::TYPE[1]);
        $tournament->setOrganizer($this->getReference(ClubFixtures::CLUB_ITW));
        $tournament->setTitle("ITW : Jeunes - 50-30 - 2x25");
        $tournament->setLocation($this->getReference(LocationFixtures::LOC_ITW));
        $tournament->setContact("contact@whitebear.be");
        $tournament->setInformation("Paiement sur place le jour du tir — Petite restauration : Pain saucisse : 3€");
        $manager->persist($tournament);

        $this->addReference(self::TOURN_ITW, $tournament);

        $manager->flush();
    }
}
