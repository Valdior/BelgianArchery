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
        $peloton = new Peloton();
        $peloton->setMaxParticipant(40);
        $peloton->setType(Peloton::TYPE_18);
        $peloton->setStartTime(new \DateTime("01/11/2020 10:00:00"));
        $peloton->setTournament($this->getReference(TournamentFixtures::TOURN_PAC));
        $manager->persist($peloton);

        $peloton = new Peloton();
        $peloton->setMaxParticipant(40);
        $peloton->setType(Peloton::TYPE_18);
        $peloton->setStartTime(new \DateTime("01/11/2020 14:30:00"));
        $peloton->setTournament($this->getReference(TournamentFixtures::TOURN_PAC));
        $manager->persist($peloton);

        $peloton = new Peloton();
        $peloton->setMaxParticipant(40);
        $peloton->setType(Peloton::TYPE_18);
        $peloton->setStartTime(new \DateTime("01/12/2020 13:15:00"));
        $peloton->setTournament($this->getReference(TournamentFixtures::TOURN_PAC));
        $manager->persist($peloton);

        $peloton = new Peloton();
        $peloton->setMaxParticipant(24);
        $peloton->setType(Peloton::TYPE_18);
        $peloton->setStartTime(new \DateTime("01/11/2020 13:30:00"));
        $peloton->setTournament($this->getReference(TournamentFixtures::TOURN_ACG));
        $manager->persist($peloton);

        $peloton = new Peloton();
        $peloton->setMaxParticipant(24);
        $peloton->setType(Peloton::TYPE_18);
        $peloton->setStartTime(new \DateTime("01/11/2020 18:30:00"));
        $peloton->setTournament($this->getReference(TournamentFixtures::TOURN_ACG));
        $manager->persist($peloton);

        $peloton = new Peloton();
        $peloton->setMaxParticipant(24);
        $peloton->setType(Peloton::TYPE_18);
        $peloton->setStartTime(new \DateTime("01/12/2020 13:30:00"));
        $peloton->setTournament($this->getReference(TournamentFixtures::TOURN_ACG));
        $manager->persist($peloton);

        $peloton = new Peloton();
        $peloton->setMaxParticipant(12);
        $peloton->setType(Peloton::TYPE_18);
        $peloton->setStartTime(new \DateTime("01/18/2020 13:30:00"));
        $peloton->setTournament($this->getReference(TournamentFixtures::TOURN_ANT));
        $manager->persist($peloton);

        $peloton = new Peloton();
        $peloton->setMaxParticipant(12);
        $peloton->setType(Peloton::TYPE_18);
        $peloton->setStartTime(new \DateTime("01/18/2020 18:30:00"));
        $peloton->setTournament($this->getReference(TournamentFixtures::TOURN_ANT));
        $manager->persist($peloton);

        $peloton = new Peloton();
        $peloton->setMaxParticipant(12);
        $peloton->setType(Peloton::TYPE_18);
        $peloton->setStartTime(new \DateTime("01/19/2020 13:30:00"));
        $peloton->setTournament($this->getReference(TournamentFixtures::TOURN_ANT));
        $manager->persist($peloton);

        $peloton = new Peloton();
        $peloton->setMaxParticipant(72);
        $peloton->setType(Peloton::TYPE_18);
        $peloton->setStartTime(new \DateTime("01/12/2020 14:00:00"));
        $peloton->setTournament($this->getReference(TournamentFixtures::TOURN_GAU));
        $manager->persist($peloton);

        $peloton = new Peloton();
        $peloton->setMaxParticipant(88);
        $peloton->setType(Peloton::TYPE_18);
        $peloton->setStartTime(new \DateTime("01/19/2020 08:30:00"));
        $peloton->setTournament($this->getReference(TournamentFixtures::TOURN_ITW));
        $manager->persist($peloton);

        $this->addReference(self::PEL_ITW, $peloton);

        $peloton = new Peloton();
        $peloton->setMaxParticipant(88);
        $peloton->setType(Peloton::TYPE_18);
        $peloton->setStartTime(new \DateTime("01/19/2020 13:30:00"));
        $peloton->setTournament($this->getReference(TournamentFixtures::TOURN_ITW));
        $manager->persist($peloton);

        $peloton = new Peloton();
        $peloton->setMaxParticipant(45);
        $peloton->setType(Peloton::TYPE_18);
        $peloton->setStartTime(new \DateTime("01/25/2020 13:30:00"));
        $peloton->setTournament($this->getReference(TournamentFixtures::TOURN_ABA));
        $manager->persist($peloton);

        $peloton = new Peloton();
        $peloton->setMaxParticipant(45);
        $peloton->setType(Peloton::TYPE_18);
        $peloton->setStartTime(new \DateTime("01/25/2020 18:30:00"));
        $peloton->setTournament($this->getReference(TournamentFixtures::TOURN_ABA));
        $manager->persist($peloton);

        $peloton = new Peloton();
        $peloton->setMaxParticipant(45);
        $peloton->setType(Peloton::TYPE_18);
        $peloton->setStartTime(new \DateTime("01/26/2020 13:30:00"));
        $peloton->setTournament($this->getReference(TournamentFixtures::TOURN_ABA));
        $manager->persist($peloton);

        $peloton = new Peloton();
        $peloton->setMaxParticipant(92);
        $peloton->setType(Peloton::TYPE_18);
        $peloton->setStartTime(new \DateTime("02/29/2020 13:30:00"));
        $peloton->setTournament($this->getReference(TournamentFixtures::TOURN_TEL));
        $manager->persist($peloton);

        $peloton = new Peloton();
        $peloton->setMaxParticipant(92);
        $peloton->setType(Peloton::TYPE_18);
        $peloton->setStartTime(new \DateTime("03/01/2020 08:30:00"));
        $peloton->setTournament($this->getReference(TournamentFixtures::TOURN_TEL));
        $manager->persist($peloton);

        $peloton = new Peloton();
        $peloton->setMaxParticipant(92);
        $peloton->setType(Peloton::TYPE_18);
        $peloton->setStartTime(new \DateTime("03/01/2020 13:30:00"));
        $peloton->setTournament($this->getReference(TournamentFixtures::TOURN_TEL));
        $manager->persist($peloton);

        $peloton = new Peloton();
        $peloton->setMaxParticipant(24);
        $peloton->setType(Peloton::TYPE_18);
        $peloton->setStartTime(new \DateTime("03/07/2020 13:30:00"));
        $peloton->setTournament($this->getReference(TournamentFixtures::TOURN_HUY));
        $manager->persist($peloton);

        $peloton = new Peloton();
        $peloton->setMaxParticipant(24);
        $peloton->setType(Peloton::TYPE_18);
        $peloton->setStartTime(new \DateTime("03/07/2020 18:30:00"));
        $peloton->setTournament($this->getReference(TournamentFixtures::TOURN_HUY));
        $manager->persist($peloton);

        $peloton = new Peloton();
        $peloton->setMaxParticipant(24);
        $peloton->setType(Peloton::TYPE_18);
        $peloton->setStartTime(new \DateTime("03/08/2020 13:30:00"));
        $peloton->setTournament($this->getReference(TournamentFixtures::TOURN_HUY));
        $manager->persist($peloton);

        $peloton = new Peloton();
        $peloton->setMaxParticipant(52);
        $peloton->setType(Peloton::TYPE_18);
        $peloton->setStartTime(new \DateTime("03/14/2020 13:00:00"));
        $peloton->setTournament($this->getReference(TournamentFixtures::TOURN_HAC));
        $manager->persist($peloton);

        $peloton = new Peloton();
        $peloton->setMaxParticipant(52);
        $peloton->setType(Peloton::TYPE_18);
        $peloton->setStartTime(new \DateTime("03/14/2020 18:00:00"));
        $peloton->setTournament($this->getReference(TournamentFixtures::TOURN_HAC));
        $manager->persist($peloton);

        $peloton = new Peloton();
        $peloton->setMaxParticipant(52);
        $peloton->setType(Peloton::TYPE_18);
        $peloton->setStartTime(new \DateTime("03/15/2020 08:30:00"));
        $peloton->setTournament($this->getReference(TournamentFixtures::TOURN_HAC));
        $manager->persist($peloton);

        $peloton = new Peloton();
        $peloton->setMaxParticipant(52);
        $peloton->setType(Peloton::TYPE_18);
        $peloton->setStartTime(new \DateTime("03/15/2020 13:30:00"));
        $peloton->setTournament($this->getReference(TournamentFixtures::TOURN_HAC));
        $manager->persist($peloton);

        $peloton = new Peloton();
        $peloton->setMaxParticipant(48);
        $peloton->setType(Peloton::TYPE_18);
        $peloton->setStartTime(new \DateTime("03/28/2020 13:00:00"));
        $peloton->setTournament($this->getReference(TournamentFixtures::TOURN_LFU));
        $manager->persist($peloton);

        $peloton = new Peloton();
        $peloton->setMaxParticipant(48);
        $peloton->setType(Peloton::TYPE_18);
        $peloton->setStartTime(new \DateTime("03/28/2020 18:00:00"));
        $peloton->setTournament($this->getReference(TournamentFixtures::TOURN_LFU));
        $manager->persist($peloton);

        $peloton = new Peloton();
        $peloton->setMaxParticipant(48);
        $peloton->setType(Peloton::TYPE_18);
        $peloton->setStartTime(new \DateTime("03/29/2020 13:00:00"));
        $peloton->setTournament($this->getReference(TournamentFixtures::TOURN_LFU));
        $manager->persist($peloton);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            TournamentFixtures::class
        );
    }
}
 