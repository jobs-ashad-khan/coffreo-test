<?php

namespace App\Service;

use App\Repository\CoffeeIntensityRepository;
use App\Repository\CoffeeSizeRepository;
use App\Repository\CoffeeTypeRepository;
use Doctrine\ORM\EntityManagerInterface;

class CoffeeService
{
    public function __construct(
        private CoffeeTypeRepository $coffeeTypeRepository,
        private CoffeeIntensityRepository $coffeeIntensityRepository,
        private CoffeeSizeRepository $coffeeSizeRepository,
    ) {}

    public function getCoffeeTypes()
    {
        return $this->coffeeTypeRepository->findAll();
    }

    public function getCoffeeIntensities()
    {
        return $this->coffeeIntensityRepository->findAll();
    }

    public function getCoffeeSizes()
    {
        return $this->coffeeSizeRepository->findAll();
    }
}