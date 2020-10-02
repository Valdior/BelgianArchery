<?php

namespace App\DataFixtures;

use App\Entity\ArcherCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArcherCategoryFixtures extends Fixture
{
    private const sexes = ["Homme", "Dame"];
    private const arcs = ["Recurve", "Compound"];
    private const categories = ["Pupille", "Benjamin", "Cadet", "Junior", "Senior 1", "Senior 2", "Master", "Veteran"];

    public const CAT_RH1 = "cat-RH1";
    public const CAT_RH2 = "cat-RH2";


    public function load(ObjectManager $manager)
    {
        foreach(self::categories as $cat)
        {
            if(substr($cat, -1, 1) == "1" || substr($cat, -1, 1) == "2")
                $cpt = substr($cat, -1, 1);      

            foreach(self::sexes as $sexe)
            {
                foreach(self::arcs as $arc)
                {
                    $category = new ArcherCategory();
                    $category->setName($arc . ' ' . $sexe . ' ' . $cat);
                    $category->setMinimumAge(0);

                    if(substr($cat, 0, 1) == "S")
                        $category->setAcronym(substr($arc, 0, 1) . substr($sexe, 0, 1) . $cpt);
                    else                    
                        $category->setAcronym(substr($arc, 0, 1) . substr($sexe, 0, 1) . substr($cat, 0, 1));

                    $manager->persist($category);

                    $this->addReference('cat-' . $category->getAcronym(), $category);
                }
            }
        }

        $manager->flush();
    }
}
