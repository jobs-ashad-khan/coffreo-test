<?php

namespace App\DataFixtures;

use App\Entity\CoffeeType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CoffeeTypeFixtures extends Fixture
{
    CONST DATA = [
        "Expresso",
        "Cappuccino",
        "Nespresso",
        "Latte"
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::DATA as $name) {
            $coffeeType = new CoffeeType($name);
            $manager->persist($coffeeType);
        }

        $manager->flush();
    }
}
