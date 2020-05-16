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
        // $participant = new Participant();
        // $participant->setArcher($this->getReference(ArcherFixtures::ARCHER_MP));
        // $participant->setPeloton($this->getReference(PelotonFixtures::PEL_ITW));
        // $participant->setCategory($this->getReference(ArcherCategoryFixtures::CAT_RH1));
        // $manager->persist($participant);
        
        // $manager->flush($participant);
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
