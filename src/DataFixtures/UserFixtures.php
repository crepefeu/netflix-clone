<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Enum\UserAccountStatusEnum;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager)
    {
        // Créer un admin
        $admin = new User();
        $admin->setEmail('admin@example.com');
        $admin->setUsername('admin');
        $admin->setAccountStatus(UserAccountStatusEnum::ACTIVE);
        $hashedPassword = $this->passwordHasher->hashPassword($admin, 'adminpass');
        $admin->setPassword($hashedPassword);
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setCurrentSubscription($this->getReference(SubscriptionFixtures::PREMIUM_SUBSCRIPTION_REFERENCE));
        $manager->persist($admin);

        // Créer un utilisateur standard
        $user = new User();
        $user->setEmail('user@example.com');
        $user->setUsername('user');
        $user->setAccountStatus(UserAccountStatusEnum::ACTIVE);
        $hashedPassword = $this->passwordHasher->hashPassword($user, 'userpass');
        $user->setPassword($hashedPassword);
        $user->setCurrentSubscription($this->getReference(SubscriptionFixtures::BASIC_SUBSCRIPTION_REFERENCE));
        // ROLE_USER est déjà défini par défaut dans l'entité
        $manager->persist($user);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            SubscriptionFixtures::class,
        ];
    }
}