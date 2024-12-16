<?php
// src/DataFixtures/SubscriptionFixtures.php
namespace App\DataFixtures;

use App\Entity\Subscription;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SubscriptionFixtures extends Fixture
{
    public const PREMIUM_SUBSCRIPTION_REFERENCE = 'premium-subscription';
    public const BASIC_SUBSCRIPTION_REFERENCE = 'basic-subscription';

    public function load(ObjectManager $manager)
    {
        $premiumSub = new Subscription();
        $premiumSub->setName('Premium');
        $premiumSub->setPrice('14.99');
        $premiumSub->setDurationInMonths(1);
        $manager->persist($premiumSub);
        $this->addReference(self::PREMIUM_SUBSCRIPTION_REFERENCE, $premiumSub);

        $basicSub = new Subscription();
        $basicSub->setName('Basic');
        $basicSub->setPrice('9.99');
        $basicSub->setDurationInMonths(1);
        $manager->persist($basicSub);
        $this->addReference(self::BASIC_SUBSCRIPTION_REFERENCE, $basicSub);

        $manager->flush();
    }
}