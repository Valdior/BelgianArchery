<?php

namespace App\DataFixtures;

use App\Entity\BlogPost;
use App\DataFixtures\UserFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class BlogPostFixtures extends Fixture implements DependentFixtureInterface
{    
    public function load(ObjectManager $manager)
    {  

        for($cpt = 0; $cpt < 10; $cpt++)
        {
            $post = new BlogPost();

            $post
                ->setTitle('Your first blog post example ' . $cpt)
                ->setDescription('Lorem Ipsum')
                ->setBody('Contrary to popular belief, lorem ipsum is not simply')
                ->setAuthor($this->getReference(UserFixtures::USER_ADMIN))
                ;

            if($cpt % 2 == 0)
            {
                $post->setIsPublished(true);
            }

            $manager->persist($post);
        }
        
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
        );
    }
}
