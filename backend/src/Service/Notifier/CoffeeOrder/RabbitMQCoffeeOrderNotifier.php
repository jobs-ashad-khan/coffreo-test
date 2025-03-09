<?php

namespace App\Service\Notifier\CoffeeOrder;

use App\Entity\CoffeeOrder;
use App\Message\PrepareCoffeeMessage;
use Symfony\Component\Messenger\MessageBusInterface;

class RabbitMQCoffeeOrderNotifier implements CoffeeOrderNotifierInterface
{
    public function __construct(
        private MessageBusInterface $bus
    ) {}

    public function notify(CoffeeOrder $coffeeOrder): void
    {
        $this->bus->dispatch(new PrepareCoffeeMessage($coffeeOrder->getId()));
    }
}