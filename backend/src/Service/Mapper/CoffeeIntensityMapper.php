<?php

namespace App\Service\Mapper;

use App\DTO\CoffeeIntensityDTO;
use App\Entity\CoffeeIntensity;

class CoffeeIntensityMapper
{
    public static function toResponseDTO(CoffeeIntensity $coffeeIntensity): CoffeeIntensityDTO
    {
        return new CoffeeIntensityDTO(
            id: $coffeeIntensity->getId(),
            intensity: $coffeeIntensity->getLevel()
        );
    }

    public static function toResponseArray(array $coffeeIntensities): array
    {
        $responseArray = [];
        foreach ($coffeeIntensities as $coffeeIntensity) {
            $responseArray[] = self::toResponseDTO($coffeeIntensity);
        }

        return $responseArray;
    }
}