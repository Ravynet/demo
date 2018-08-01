<?php

namespace App\DataFixtures;

use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{

    private $faker;

    public function load(ObjectManager $manager)
    {
        $this->faker = Factory::create();
        $this->addPosts($manager);
        $manager->flush();
    }

    private function addPosts(ObjectManager $manager)
    {
        for ($i = 1; $i <= 10; $i++) {
            $post = new Post([
                'title' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
                'description' => $this->faker->realText($maxNbChars = 800, $indexSize = 2),
                'date' => $this->faker->dateTimeBetween('-2 years', 'now'),
            ]);

//            $post->setTitle($this->faker->sentence($nbWords = 6, $variableNbWords = true));
//            $post->setDescription($this->faker->realText($maxNbChars = 800, $indexSize = 2));
//            $post->setDate($this->faker->dateTimeBetween('-2 years', 'now'));

            $manager->persist($post);
        }
    }
}
