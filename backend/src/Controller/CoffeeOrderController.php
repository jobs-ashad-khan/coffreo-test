<?php

namespace App\Controller;

use App\DTO\CoffeeDTO;
use App\DTO\CoffeeOrderDTO;
use App\Service\CoffeeOrderService;
use App\Service\Mapper\CoffeeOrderMapper;
use App\Service\Notifier\CoffeeOrder\CoffeeOrderNotifierInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/coffee-orders')]
final class CoffeeOrderController extends AbstractController
{
    public function __construct(
        private CoffeeOrderService $coffeeOrderService,
        private CoffeeOrderNotifierInterface $coffeeOrderNotifier,
    ) {}

    #[Route('', name: 'create_coffee_order', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        // Récupération de la request dans le CoffeeDTO
        $data = json_decode($request->getContent(), true);
        $requestDTO = new CoffeeDTO($data['type'], $data['intensity'], $data['size']);

        // Création et Sauvegarde du CoffeeOrder en base de données
        $coffeeOrder = $this->coffeeOrderService->createCoffeeOrder($requestDTO);

        // Lancer la préparation du café
        $this->coffeeOrderNotifier->notify($coffeeOrder);

        // Conversion en CoffeeOrderDTO et Renvoie de la réponse en json
        return $this->json(CoffeeOrderMapper::toResponseDTO($coffeeOrder));
    }
}
