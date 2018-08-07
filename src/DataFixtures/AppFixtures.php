<?php

namespace App\DataFixtures;

use App\Entity\Post;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    private $faker;
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $this->faker = Factory::create();
        $this->addPosts($manager);
        $this->addUser($manager);
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

    private function addUser(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('admin');
        $user->setRoles(['ROLE_ADMIN']);
        $encodedPassword = $this->encoder->encodePassword($user, 'password');
        $user->setPassword($encodedPassword);
        $manager->persist($user);
    }
}
