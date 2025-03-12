<?php

namespace App\DTO;

class CoffeeTypeDTO
{
    public function __construct(
        public string $id,
        public string $type,
    ) {}
}