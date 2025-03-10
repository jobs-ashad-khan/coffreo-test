<?php

namespace App\Service;

use App\DTO\CoffeeDTO;
use App\Entity\CoffeeOrder;
use App\Enum\CoffeeOrderStatus;
use App\Service\Factory\CoffeeFactory;
use Doctrine\ORM\EntityManagerInterface;

class CoffeeOrderService
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private CoffeeFactory $coffeeFactory,
    ) {}

    public function saveCoffeeOrder(CoffeeOrder $coffeeOrder): CoffeeOrder
    {
        $this->entityManager->persist($coffeeOrder);
        $this->entityManager->flush();

        return $coffeeOrder;
    }

    public function getAllCoffeeOrders(): array
    {
        return $this->entityManager->getRepository(CoffeeOrder::class)->findBy([], ['createdAt' => 'DESC']);
    }

    public function getCoffeeOrderById(int $id): CoffeeOrder
    {
        return $this->entityManager->getRepository(CoffeeOrder::class)->find($id);
    }

    public function createCoffeeOrder(CoffeeDTO $coffeeDTO): CoffeeOrder
    {
        $coffee = $this->coffeeFactory->createCoffeeFromDTO($coffeeDTO);

        $coffeeOrder = new CoffeeOrder();
        $coffeeOrder->setCoffee($coffee);
        $coffeeOrder->setCreatedAt(new \DateTime());
        $coffeeOrder->setStatus(CoffeeOrderStatus::PENDING);

        $this->saveCoffeeOrder($coffeeOrder);

        return $coffeeOrder;
    }

    public function updateCoffeeOrderStatus(CoffeeOrder $coffeeOrder, CoffeeOrderStatus $status): CoffeeOrder
    {
        $coffeeOrder->setStatus($status);
        $this->saveCoffeeOrder($coffeeOrder);

        return $coffeeOrder;
    }
}