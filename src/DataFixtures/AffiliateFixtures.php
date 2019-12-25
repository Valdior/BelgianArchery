<?php

namespace App\DataFixtures;

use App\Entity\Affiliate;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class AffiliateFixtures extends Fixture  implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $affiliate = new Affiliate();
        $affiliate->setAffiliateNumber("414022");
        $affiliate->setAffiliateSince(new \DateTime("10/01/2014"));
        $affiliate->setAffiliateEnd(new \DateTime("09/30/2016"));
        $affiliate->setClub($this->getReference(ClubFixtures::CLUB_ITW));
        $affiliate->setArcher($this->getReference(ArcherFixtures::ARCHER_MP));
        $manager->persist($affiliate);

        $affiliate = new Affiliate();
        $affiliate->setAffiliateNumber("89H01558");
        $affiliate->setAffiliateSince(new \DateTime("10/01/2016"));
        $affiliate->setClub($this->getReference(ClubFixtures::CLUB_LIE));
        $affiliate->setArcher($this->getReference(ArcherFixtures::ARCHER_MP));
        $manager->persist($affiliate);

        $affiliate = new Affiliate();
        $affiliate->setAffiliateNumber("70H01956");
        $affiliate->setAffiliateSince(new \DateTime("11/01/2016"));
        $affiliate->setClub($this->getReference(ClubFixtures::CLUB_ITW));
        $affiliate->setArcher($this->getReference(ArcherFixtures::ARCHER_LP));
        $manager->persist($affiliate);

        $affiliate = new Affiliate();
        $affiliate->setAffiliateNumber("72H01929");
        $affiliate->setAffiliateSince(new \DateTime("01/01/2010"));
        $affiliate->setClub($this->getReference(ClubFixtures::CLUB_ITW));
        $affiliate->setArcher($this->getReference(ArcherFixtures::ARCHER_BA));
        $manager->persist($affiliate);

        $affiliate = new Affiliate();
        $affiliate->setAffiliateNumber("83H01527");
        $affiliate->setAffiliateSince(new \DateTime("09/01/2015"));
        $affiliate->setClub($this->getReference(ClubFixtures::CLUB_LIE));
        $affiliate->setArcher($this->getReference(ArcherFixtures::ARCHER_GC));
        $manager->persist($affiliate);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ClubFixtures::class,
            ArcherFixtures::class,
        );
    }
}
