<?php

namespace App\Mapper\CoffeeOrder;

use App\DTO\CoffeeDTO;
use App\DTO\CoffeeOrderDTO;
use App\DTO\CreateCoffeeOrderRequestDTO;
use App\DTO\CreateCoffeeOrderResponseDTO;
use App\Entity\Coffee;
use App\Entity\CoffeeIntensity;
use App\Entity\CoffeeOrder;
use App\Entity\CoffeeSize;
use App\Entity\CoffeeType;
use App\Enum\CoffeeOrderStatus;
use Doctrine\ORM\EntityManagerInterface;

class CreateCoffeeOrderMapper
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {}

    private function fetchCoffee(string $type, int $intensity, string $size): Coffee
    {
        $coffeeType = $this->entityManager->getRepository(CoffeeType::class)->findOneByName($type);
        $coffeeIntensity = $this->entityManager->getRepository(CoffeeIntensity::class)->findOneByLevel($intensity);
        $coffeeSize = $this->entityManager->getRepository(CoffeeSize::class)->findOneBySize($size);

        $coffee = new Coffee();
        $coffee->setType($coffeeType);
        $coffee->setIntensity($coffeeIntensity);
        $coffee->setSize($coffeeSize);

        return $coffee;
    }

    public function fromCreateCoffeeOrderRequestDTO(CreateCoffeeOrderRequestDTO $coffeeOrderRequestDTO): CoffeeOrder
    {
        $coffee = $this->fetchCoffee($coffeeOrderRequestDTO->type, $coffeeOrderRequestDTO->intensity, $coffeeOrderRequestDTO->size);

        $coffeeOrder = new CoffeeOrder();
        $coffeeOrder->setCoffee($coffee);
        $coffeeOrder->setCreatedAt(new \DateTime());
        $coffeeOrder->setStatus(CoffeeOrderStatus::PENDING);

        return $coffeeOrder;
    }

    public function toCreateCoffeeOrderResponseDTO(CoffeeOrder $coffeeOrder): CreateCoffeeOrderResponseDTO
    {
        $coffee = $coffeeOrder->getCoffee();

        return new CreateCoffeeOrderResponseDTO(
            new CoffeeOrderDTO(
                id: $coffeeOrder->getId(),
                status: $coffeeOrder->getStatus()->value,
                coffee: new CoffeeDTO(
                    name: $coffee->getType()->getName(),
                    intensity: $coffee->getIntensity()->getLevel(),
                    size: $coffee->getSize()->getSize()->value,
                )
            )
        );
    }
}