<?php

namespace App\DataFixtures;

use App\Entity\Peloton;
use App\DataFixtures\TournamentFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PelotonFixtures extends Fixture implements DependentFixtureInterface
{
    public const PEL_ITW = "PEL_ITW";

    public function load(ObjectManager $manager)
    {
        // $peloton = new Peloton();
        // $peloton->setMaxParticipant(48);
        // $peloton->setType(Peloton::TYPE_18);
        // $peloton->setStartTime(new \DateTime("03/29/2020 13:00:00"));
        // $peloton->setTournament($this->getReference(TournamentFixtures::TOURN_ITW));
        // $manager->persist($peloton);

        // $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            TournamentFixtures::class
        );
    }
}
 