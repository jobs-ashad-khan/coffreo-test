<?php

namespace App\Dto;

use App\Entity\Coffee;
use App\Entity\CoffeeIntensity;
use App\Entity\CoffeeOrder;
use App\Entity\CoffeeSize;
use App\Entity\CoffeeType;
use App\Enum\CoffeeOrderStatus;

class CreateCoffeeOrderRequestDto
{
    private string $type;

    private int $intensity;

    private string $size;

    public function __construct(string $type, int $intensity, string $size)
    {
        $this->type = $type;
        $this->intensity = $intensity;
        $this->size = $size;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getIntensity(): int
    {
        return $this->intensity;
    }

    public function getSize(): string
    {
        return $this->size;
    }

    public function toCoffeeOrder(): CoffeeOrder
    {
        $coffee = new Coffee();
        $coffee->setType(new CoffeeType($this->type));
        $coffee->setIntensity(new CoffeeIntensity($this->intensity));
        $coffee->setSize(new CoffeeSize($this->size));

        $coffeeOrder = new CoffeeOrder();
        $coffeeOrder->setCoffee($coffee);
        $coffeeOrder->setCreatedAt(new \DateTime());
        $coffeeOrder->setStatus(CoffeeOrderStatus::PENDING);

        return $coffeeOrder;
    }
}