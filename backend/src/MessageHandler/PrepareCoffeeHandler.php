<?php

namespace App\MessageHandler;

use App\Entity\CoffeeOrder;
use App\Enum\CoffeeOrderStatus;
use App\Message\PrepareCoffeeMessage;
use App\Service\CoffeeOrderService;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class PrepareCoffeeHandler
{
    public function __construct(
        private CoffeeOrderService $coffeeOrderService,
        private HubInterface $hub,
    ) {}

    private function sendUpdate(CoffeeOrder $coffeeOrder): void
    {
        $update = new Update(
            "coffee-orders/update",
            json_encode([
                'id' => $coffeeOrder->getId(),
                'status' => $coffeeOrder->getStatus()->value,
            ])
        );

        echo "Messsage that will send : " . json_encode($update);

        $this->hub->publish($update);
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
        sleep(5);
        $this->coffeeOrderService->updateCoffeeOrderStatus($coffeeOrder, CoffeeOrderStatus::DONE);
        $this->sendUpdate($coffeeOrder);
    }
}