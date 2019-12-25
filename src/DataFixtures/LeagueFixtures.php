<?php

namespace App\DataFixtures;

use App\Entity\League;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LeagueFixtures extends Fixture
{
    public const LEAGUE_LFBTA = 'LFBTA';
    public const LEAGUE_HBL = 'HBL';
    public function load(ObjectManager $manager)
    {
        $league = new League();
        $league->setName("Ligue Francophone Belge de Tir à l'Arc");
        $league->setAcronym("LFBTA");
        $manager->persist($league);
        $this->addReference(self::LEAGUE_LFBTA, $league);
        $league = new League();
        $league->setName("Handboogliga");
        $league->setAcronym("HBL");
        $manager->persist($league);
        $this->addReference(self::LEAGUE_HBL, $league);
        $manager->flush();
    }
}