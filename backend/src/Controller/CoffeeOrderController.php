<?php

namespace App\Controller;

use App\Dto\CreateCoffeeOrderRequestDto;
use App\Dto\CreateCoffeeOrderResponseDto;
use App\Entity\Coffee;
use App\Entity\CoffeeIntensity;
use App\Entity\CoffeeOrder;
use App\Entity\CoffeeType;
use App\Service\CoffeeOrderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/coffee-orders')]
final class CoffeeOrderController extends AbstractController
{
    public function __construct(
        private CoffeeOrderService $coffeeOrderService,
        private MessageBusInterface $bus
    ) {}

    #[Route('', name: 'create_coffee_order', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $requestDto = new CreateCoffeeOrderRequestDto($data['type'], $data['intensity'], $data['size']);
        $coffeeOrder = $requestDto->toCoffeeOrder();

        $coffeeOrder = $this->coffeeOrderService->createCoffeeOrder($coffeeOrder);
        $responseDto = new CreateCoffeeOrderResponseDto($coffeeOrder);

        return $this->json($responseDto->getResponse());
    }
}
