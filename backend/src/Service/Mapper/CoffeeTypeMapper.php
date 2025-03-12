<?php

namespace App\Service\Mapper;

use App\DTO\CoffeeTypeDTO;
use App\Entity\CoffeeType;

class CoffeeTypeMapper
{
    public static function toResponseDTO(CoffeeType $coffeeType): CoffeeTypeDTO
    {
        return new CoffeeTypeDTO(
            id: $coffeeType->getId(),
            type: $coffeeType->getName()
        );
    }

    public static function toResponseArray(array $coffeeTypes): array
    {
        $responseArray = [];
        foreach ($coffeeTypes as $coffeeType) {
            $responseArray[] = self::toResponseDTO($coffeeType);
        }

        return $responseArray;
    }
}