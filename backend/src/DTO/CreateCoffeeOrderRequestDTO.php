<?php

namespace App\DTO;

class CreateCoffeeOrderRequestDTO
{
    public function __construct(
        public string $type,
        public int $intensity,
        public string $size
    ) {}
}