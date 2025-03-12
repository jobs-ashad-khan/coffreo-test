<?php

namespace App\DTO;

class CoffeeIntensityDTO
{
    public function __construct(
        public string $id,
        public string $intensity,
    ) {}
}