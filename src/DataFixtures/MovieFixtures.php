<?php

namespace App\DataFixtures;

use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class MovieFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $movie = new Movie();
            $movie->setTitle($faker->sentence(3));
            $movie->setReleaseDate($faker->dateTimeThisCentury());
            $movie->setShortDescription($faker->text(10));
            $movie->setLongDescription($faker->text(100));
            $movie->setCoverImage($faker->imageUrl());


            $manager->persist($movie);
        }

        $manager->flush();
    }
}