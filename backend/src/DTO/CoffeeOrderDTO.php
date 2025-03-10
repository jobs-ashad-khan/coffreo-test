<?php

namespace App\DTO;

use App\Entity\CoffeeOrder;

class CoffeeOrderDTO
{
    public function __construct(
        public string $id,
        public string $status,
        public CoffeeDTO $coffee,
    ) {}
}