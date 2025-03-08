<?php

namespace App\DTO;

class CoffeeOrderDTO
{
    public function __construct(
        public string $id,
        public string $status,
        public CoffeeDTO $coffee,
    ) {}
}