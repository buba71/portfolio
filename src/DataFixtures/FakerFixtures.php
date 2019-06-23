<?php

// src/DataFixtures/FakerFixtures.php
namespace App\DataFixtures;

use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class FakerFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $post = new Post();
            $post->setTitle($faker->word);
            $post->setContent($faker->text);
            $manager->persist($post);
        }

        $manager->flush();
    }
}