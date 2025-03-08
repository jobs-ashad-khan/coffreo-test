<?php

namespace App\Dto;

use App\Entity\CoffeeOrder;
use Symfony\Component\HttpFoundation\JsonResponse;

class CreateCoffeeOrderResponseDto
{
    private CoffeeOrder $coffeeOrder;

    public function __construct(CoffeeOrder $coffeeOrder)
    {
        $this->coffeeOrder = $coffeeOrder;
    }

    public function getCoffeeOrder(): CoffeeOrder
    {
        return $this->coffeeOrder;
    }

    public function getResponse(): array
    {
        return [
            'coffee_order_id' => $this->coffeeOrder->getId(),
            'coffee_order_status' => $this->coffeeOrder->getStatus(),
            'coffee' => [
                'name' => $this->coffeeOrder->getCoffee()->getType()->getName(),
                'intensity' => $this->coffeeOrder->getCoffee()->getIntensity(),
                'size' => $this->coffeeOrder->getCoffee()->getSize(),
            ]
        ];
    }
}