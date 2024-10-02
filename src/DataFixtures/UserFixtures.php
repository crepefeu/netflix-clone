<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Enum\UserAccountStatusEnum;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setUsername($faker->userName);
            $user->setEmail($faker->email);
            $user->setPassword(password_hash($faker->password, PASSWORD_BCRYPT));
            $user->setAccountStatus(userAccountStatusEnum::ACTIVE);

            $manager->persist($user);
        }

        $manager->flush();
    }
}