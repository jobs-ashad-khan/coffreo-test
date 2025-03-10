<?php

namespace App\Service\Mapper;

use App\DTO\CoffeeDTO;
use App\DTO\CoffeeOrderDTO;
use App\Entity\CoffeeOrder;

class CoffeeOrderMapper
{
    public static function toResponseDTO(CoffeeOrder $coffeeOrder): CoffeeOrderDTO
    {
        return new CoffeeOrderDTO(
            id: $coffeeOrder->getId(),
            status: $coffeeOrder->getStatus()->value,
            coffee: new CoffeeDTO(
                type: $coffeeOrder->getCoffee()->getType()->getName(),
                intensity: $coffeeOrder->getCoffee()->getIntensity()->getLevel(),
                size: $coffeeOrder->getCoffee()->getSize()->getSize()->value
            )
        );
    }
}