<?php

namespace App\DataFixtures;

use App\Entity\Location;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LocationFixtures extends Fixture 
{
    public const LOC_ITW = "loc-itw";

    public function load(ObjectManager $manager)
    {
        $location = new Location();
        $location->setTitle("Intertir Welkenraedt");
        $location->setStreet("Rue de Baelen");
        $location->setPostalcode(4840);
        $location->setCity("Welkenraedt");
        $location->setLocality("Intertir Welkenraedt");
        $manager->persist($location);

        $this->addReference(self::LOC_ITW, $location);

        $manager->flush();
    }
}
