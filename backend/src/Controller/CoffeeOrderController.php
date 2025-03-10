<?php

namespace App\Controller;

use App\DTO\CoffeeDTO;
use App\Service\CoffeeOrderService;
use App\Service\Mapper\CoffeeOrderMapper;
use App\Service\Notifier\CoffeeOrder\CoffeeOrderNotifierInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/coffee-orders')]
final class CoffeeOrderController extends AbstractController
{
    public function __construct(
        private CoffeeOrderService $coffeeOrderService,
        private CoffeeOrderNotifierInterface $coffeeOrderNotifier,
        private SerializerInterface $serializer,
    ) {}

    #[Route('', name: 'create_coffee_order', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        // Récupération de la request dans le CoffeeDTO
        $data = $request->getContent();
        $requestDTO = $this->serializer->deserialize($data, CoffeeDTO::class, 'json');

        // Création et Sauvegarde du CoffeeOrder en base de données
        $coffeeOrder = $this->coffeeOrderService->createCoffeeOrder($requestDTO);

        // Lancer la préparation du café
        $this->coffeeOrderNotifier->notify($coffeeOrder);

        // Conversion en CoffeeOrderDTO et Renvoie de la réponse en json
        $responseDTO = CoffeeOrderMapper::toResponseDTO($coffeeOrder);
        return $this->json($responseDTO, Response::HTTP_CREATED);
    }
}
