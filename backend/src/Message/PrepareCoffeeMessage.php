<?php

namespace App\Message;

class PrepareCoffeeMessage
{
    public function __construct(
        private int $coffeeOrderId
    ) {}

    public function getCoffeeOrderId(): int
    {
        return $this->coffeeOrderId;
    }
}