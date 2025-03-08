<?php

namespace App\Service;

use App\Entity\CoffeeOrder;
use Doctrine\ORM\EntityManagerInterface;

class CoffeeOrderService
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {}

    public function createCoffeeOrder(CoffeeOrder $coffeeOrder): CoffeeOrder
    {
        $this->entityManager->persist($coffeeOrder);
        $this->entityManager->flush();

        return $coffeeOrder;
    }
}