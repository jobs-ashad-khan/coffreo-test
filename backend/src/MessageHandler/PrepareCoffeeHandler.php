<?php

namespace App\MessageHandler;

use App\Enum\CoffeeOrderStatus;
use App\Message\PrepareCoffeeMessage;
use App\Service\CoffeeOrderService;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class PrepareCoffeeHandler
{
    public function __construct(
        private CoffeeOrderService $coffeeOrderService,
    ) {}

    public function __invoke(PrepareCoffeeMessage $message): void
    {
        $coffeeOrder = $this->coffeeOrderService->getCoffeeOrderById($message->getCoffeeOrderId());
        if (!$coffeeOrder) {
            throw new NotFoundHttpException("Coffee order not found");
        }

        // Étape 1 : "Démarrage" après 5s
        sleep(5);
        $this->coffeeOrderService->updateCoffeeOrderStatus($coffeeOrder, CoffeeOrderStatus::IN_PROGRESS);

        // Étape 2 : "Prêt" après encore 10s
        sleep(10);
        $this->coffeeOrderService->updateCoffeeOrderStatus($coffeeOrder, CoffeeOrderStatus::DONE);
    }
}