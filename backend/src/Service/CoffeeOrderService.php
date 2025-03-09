<?php

namespace App\Service;

use App\Entity\CoffeeOrder;
use Doctrine\ORM\EntityManagerInterface;

class CoffeeOrderService
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {}

    public function getCoffeeOrderById(int $id): CoffeeOrder
    {
        return $this->entityManager->getRepository(CoffeeOrder::class)->find($id);
    }

    public function saveCoffeeOrder(CoffeeOrder $coffeeOrder): CoffeeOrder
    {
        $this->entityManager->persist($coffeeOrder);
        $this->entityManager->flush();

        return $coffeeOrder;
    }
}