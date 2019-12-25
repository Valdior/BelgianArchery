<?php

namespace App\DataFixtures;

use App\Entity\Participant;
use App\DataFixtures\ArcherFixtures;
use App\DataFixtures\PelotonFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\DataFixtures\ArcherCategoryFixtures;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ParticipantFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $participant = new Participant();
        $participant->setArcher($this->getReference(ArcherFixtures::ARCHER_MP));
        $participant->setPeloton($this->getReference(PelotonFixtures::PELOTON_AGC_1));
        $participant->setCategory($this->getReference(ArcherCategoryFixtures::CAT_RH1));

        $manager->persist($participant);

        $participant = new Participant();
        $participant->setArcher($this->getReference(ArcherFixtures::ARCHER_GC));
        $participant->setPeloton($this->getReference(PelotonFixtures::PELOTON_AGC_2));
        $participant->setCategory($this->getReference(ArcherCategoryFixtures::CAT_RH2));

        $manager->persist($participant);

        $participant = new Participant();
        $participant->setArcher($this->getReference(ArcherFixtures::ARCHER_MP));
        $participant->setPeloton($this->getReference(PelotonFixtures::PELOTON_CMA));
        $participant->setCategory($this->getReference(ArcherCategoryFixtures::CAT_RH1));
        $participant->setPoints(494);
        $participant->setNumberOfTen(12);
        $participant->setNumberOfNine(21);

        $manager->persist($participant);

        $participant = new Participant();
        $participant->setArcher($this->getReference(ArcherFixtures::ARCHER_BA));
        $participant->setPeloton($this->getReference(PelotonFixtures::PELOTON_CMA));
        $participant->setCategory($this->getReference(ArcherCategoryFixtures::CAT_RH2));
        $participant->setPoints(523);
        $participant->setNumberOfTen(16);
        $participant->setNumberOfNine(26);

        $manager->persist($participant);

        $participant = new Participant();
        $participant->setArcher($this->getReference(ArcherFixtures::ARCHER_LP));
        $participant->setPeloton($this->getReference(PelotonFixtures::PELOTON_CMA));
        $participant->setCategory($this->getReference(ArcherCategoryFixtures::CAT_RH2));
        $participant->setPoints(512);
        $participant->setNumberOfTen(15);
        $participant->setNumberOfNine(17);

        $manager->persist($participant);

        $participant = new Participant();
        $participant->setArcher($this->getReference(ArcherFixtures::ARCHER_MP));
        $participant->setPeloton($this->getReference(PelotonFixtures::PELOTON_GSR));
        $participant->setCategory($this->getReference(ArcherCategoryFixtures::CAT_RH1));

        $manager->persist($participant);

        $manager->flush($participant);
    }

    public function getDependencies()
    {
        return array(
            ArcherCategoryFixtures::class,
            PelotonFixtures::class,            
            ArcherFixtures::class,
        );
    }
}
