<?php

namespace App\Service\Mapper;

use App\DTO\CoffeeSizeDTO;
use App\Entity\CoffeeSize;

class CoffeeSizeMapper
{
    public static function toResponseDTO(CoffeeSize $coffeeSize): CoffeeSizeDTO
    {
        return new CoffeeSizeDTO(
            id: $coffeeSize->getId(),
            size: $coffeeSize->getSize()->value
        );
    }

    public static function toResponseArray(array $coffeeSizes): array
    {
        $responseArray = [];
        foreach ($coffeeSizes as $coffeeSize) {
            $responseArray[] = self::toResponseDTO($coffeeSize);
        }

        return $responseArray;
    }
}