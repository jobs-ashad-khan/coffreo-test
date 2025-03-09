<?php

namespace App\Service\Notifier\CoffeeOrder;

use App\Entity\CoffeeOrder;

interface CoffeeOrderNotifierInterface
{
    public function notify(CoffeeOrder $coffeeOrder): void;
}