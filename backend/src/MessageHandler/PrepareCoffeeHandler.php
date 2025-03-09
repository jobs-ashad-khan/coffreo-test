<?php

namespace App\MessageHandler;

use App\Entity\CoffeeOrder;
use App\Enum\CoffeeOrderStatus;
use App\Message\PrepareCoffeeMessage;
use App\Service\CoffeeOrderService;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class PrepareCoffeeHandler
{
    public function __construct(
        private CoffeeOrderService $coffeeOrderService,
    ) {}

    public function __invoke(PrepareCoffeeMessage $message)
    {
        $coffeeOrder = $this->coffeeOrderService->getCoffeeOrderById($message->getCoffeeOrderId());
        if (!$coffeeOrder) {

        }

        // Étape 1 : "Démarrage" après 5s
        sleep(5);
        $coffeeOrder->setStatus(CoffeeOrderStatus::IN_PROGRESS);
        $this->coffeeOrderService->saveCoffeeOrder($coffeeOrder);

        // Étape 2 : "Prêt" après encore 10s
        sleep(10);
        $coffeeOrder->setStatus(CoffeeOrderStatus::DONE);
        $this->coffeeOrderService->saveCoffeeOrder($coffeeOrder);
    }
}