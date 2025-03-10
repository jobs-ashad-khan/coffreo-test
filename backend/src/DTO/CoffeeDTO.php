<?php

namespace App\DTO;

class CoffeeDTO
{
    public function __construct(
        public string $type,
        public int $intensity,
        public string $size
    ) {}
}