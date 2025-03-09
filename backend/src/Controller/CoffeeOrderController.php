<?php

namespace App\Controller;

use App\DTO\CreateCoffeeOrderRequestDTO;
use App\Mapper\CoffeeOrder\CreateCoffeeOrderMapper;
use App\Service\CoffeeOrderService;
use App\Service\Notifier\CoffeeOrder\CoffeeOrderNotifier;
use App\Service\Notifier\CoffeeOrder\CoffeeOrderNotifierInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/coffee-orders')]
final class CoffeeOrderController extends AbstractController
{
    public function __construct(
        private CreateCoffeeOrderMapper $createCoffeeOrderMapper,
        private CoffeeOrderService $coffeeOrderService,
        private CoffeeOrderNotifierInterface $coffeeOrderNotifier,
    ) {}

    #[Route('', name: 'create_coffee_order', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        // Création d'un CoffeeOrder depuis le CreateCoffeeOrderRequestDTO
        $requestDTO = new CreateCoffeeOrderRequestDTO($data['type'], $data['intensity'], $data['size']);
        $coffeeOrder = $this->createCoffeeOrderMapper->fromCreateCoffeeOrderRequestDTO($requestDTO);

        // Sauvegarde du CoffeeOrder en base de données
        $coffeeOrder = $this->coffeeOrderService->saveCoffeeOrder($coffeeOrder);

        // Lancer la préparation du café
        $this->coffeeOrderNotifier->notify($coffeeOrder);

        // Création du CreateCoffeeOrderResponseDTO depuis le CoffeeOrder et renvoie de la réponse en json
        $responseDTO = $this->createCoffeeOrderMapper->toCreateCoffeeOrderResponseDTO($coffeeOrder);
        return $this->json($responseDTO);
    }
}
