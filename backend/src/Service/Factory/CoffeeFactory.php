<?php

namespace App\Service\Factory;

use App\DTO\CoffeeDTO;
use App\Entity\Coffee;
use App\Repository\CoffeeIntensityRepository;
use App\Repository\CoffeeSizeRepository;
use App\Repository\CoffeeTypeRepository;
use Doctrine\ORM\EntityManagerInterface;

readonly class CoffeeFactory
{
    public function __construct(
        private CoffeeTypeRepository      $coffeeTypeRepository,
        private CoffeeIntensityRepository $coffeeIntensityRepository,
        private CoffeeSizeRepository      $coffeeSizeRepository,
    ) {}

    public function createCoffeeFromDTO(CoffeeDTO $coffeeDTO): Coffee
    {
        $coffeeType = $this->coffeeTypeRepository->findOneBy(['name' => $coffeeDTO->type]);
        $coffeeIntensity = $this->coffeeIntensityRepository->findOneBy(['level' => $coffeeDTO->intensity]);
        $coffeeSize = $this->coffeeSizeRepository->findOneBy(['size' => $coffeeDTO->size]);

        if (!$coffeeType || !$coffeeIntensity || !$coffeeSize) {
            throw new \InvalidArgumentException("Invalid coffee details");
        }

        $coffee = new Coffee();
        $coffee->setType($coffeeType);
        $coffee->setIntensity($coffeeIntensity);
        $coffee->setSize($coffeeSize);

        return $coffee;
    }
}