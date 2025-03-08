<?php

namespace App\DTO;

class CoffeeDTO
{
    public function __construct(
        public string $name,
        public int $intensity,
        public string $size
    ) {}
}