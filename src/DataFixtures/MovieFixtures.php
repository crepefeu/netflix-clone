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


            $manager->persist($movie);
        }

        $manager->flush();
    }
}