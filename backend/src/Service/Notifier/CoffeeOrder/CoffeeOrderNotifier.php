<?php

namespace App\Service\Notifier\CoffeeOrder;

use App\Entity\CoffeeOrder;

interface CoffeeOrderNotifier
{
    public function notify(CoffeeOrder $coffeeOrder): void;
}