<?php

namespace App\MessageHandler;

use App\Entity\CoffeeOrder;
use App\Enum\CoffeeOrderStatus;
use App\Message\PrepareCoffeeMessage;
use App\Service\CoffeeOrderService;
use App\WebSocket\WebSocketServer;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class PrepareCoffeeHandler
{
    public function __construct(
        private CoffeeOrderService $coffeeOrderService,
        private WebSocketServer $webSocketServer,
    ) {}

    private function sendUpdate(CoffeeOrder $coffeeOrder): void
    {
        $this->webSocketServer->sendUpdate([
            "id" => $coffeeOrder->getCoffee()->getId(),
            "status" => $coffeeOrder->getStatus()->value
        ]);
    }

    public function __invoke(PrepareCoffeeMessage $message): void
    {
        $coffeeOrder = $this->coffeeOrderService->getCoffeeOrderById($message->getCoffeeOrderId());
        if (!$coffeeOrder) {
            throw new NotFoundHttpException("Coffee order not found");
        }

        // Étape 1 : "Démarrage" après 5s
        sleep(5);
        $this->coffeeOrderService->updateCoffeeOrderStatus($coffeeOrder, CoffeeOrderStatus::IN_PROGRESS);
        $this->sendUpdate($coffeeOrder);

        // Étape 2 : "Prêt" après encore 10s
        sleep(10);
        $this->coffeeOrderService->updateCoffeeOrderStatus($coffeeOrder, CoffeeOrderStatus::DONE);
        $this->sendUpdate($coffeeOrder);
    }
}