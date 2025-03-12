<?php

namespace App\DTO;

class CoffeeSizeDTO
{
    public function __construct(
        public string $id,
        public string $size,
    ) {}
}