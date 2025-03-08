<?php

namespace App\Service\Notifier\CoffeeOrder;

use App\Entity\CoffeeOrder;
use Symfony\Component\Messenger\MessageBusInterface;

class RabbitMQCoffeeOrderNotifier implements CoffeeOrderNotifier
{
    public function __construct(
        private MessageBusInterface $bus
    ) {}

    public function notify(CoffeeOrder $coffeeOrder): void
    {

    }
}