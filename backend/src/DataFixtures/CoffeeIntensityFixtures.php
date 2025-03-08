<?php

namespace App\DataFixtures;

use App\Entity\CoffeeIntensity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CoffeeIntensityFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($level=1; $level<=6; $level++) {
            $coffeeIntensity = new CoffeeIntensity($level);
            $manager->persist($coffeeIntensity);
        }

        $manager->flush();
    }
}
