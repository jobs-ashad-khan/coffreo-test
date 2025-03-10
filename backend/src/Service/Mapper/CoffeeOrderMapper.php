<?php

namespace App\Service\Mapper;

use App\DTO\CoffeeDTO;
use App\DTO\CoffeeOrderDTO;
use App\Entity\CoffeeOrder;
use Doctrine\Common\Collections\Collection;

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

    public static function toResponseArray(array $coffeeOrders): array
    {
        $responseArray = [];
        foreach ($coffeeOrders as $coffeeOrder) {
            $responseArray[] = self::toResponseDTO($coffeeOrder);
        }

        return $responseArray;
    }
}