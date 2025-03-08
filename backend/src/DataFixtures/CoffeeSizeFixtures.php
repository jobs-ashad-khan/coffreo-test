<?php

namespace App\DataFixtures;

use App\Entity\CoffeeSize;
use App\Enum\CoffeeSize  as CoffeeSizeEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CoffeeSizeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        foreach (CoffeeSizeEnum::cases() as $size) {
            $coffeeSize = new CoffeeSize($size->value);
            $manager->persist($coffeeSize);
        }

        $manager->flush();
    }
}
