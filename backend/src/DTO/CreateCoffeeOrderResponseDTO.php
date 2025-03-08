<?php

namespace App\DTO;

use App\Entity\CoffeeOrder;
use Symfony\Component\HttpFoundation\JsonResponse;

class CreateCoffeeOrderResponseDTO
{
    public function __construct(
        public CoffeeOrderDTO $coffee_order,
    ){}
}