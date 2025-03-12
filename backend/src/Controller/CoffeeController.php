<?php

namespace App\Controller;

use App\Service\CoffeeService;
use App\Service\Mapper\CoffeeIntensityMapper;
use App\Service\Mapper\CoffeeSizeMapper;
use App\Service\Mapper\CoffeeTypeMapper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CoffeeController extends AbstractController
{
    public function __construct(
        private CoffeeService $coffeeService,
    ) {}

    #[Route('/coffee-types', name: 'get_all_coffee_types', methods: ['GET'])]
    public function getTypes(): JsonResponse
    {
        $coffeeTypes = $this->coffeeService->getCoffeeTypes();

        $responseArray = CoffeeTypeMapper::toResponseArray($coffeeTypes);
        return $this->json($responseArray, Response::HTTP_OK);
    }

    #[Route('/coffee-intensities', name: 'get_all_coffee_intensities', methods: ['GET'])]
    public function getIntensities(): JsonResponse
    {
        $coffeeIntensities = $this->coffeeService->getCoffeeIntensities();

        $responseArray = CoffeeIntensityMapper::toResponseArray($coffeeIntensities);
        return $this->json($responseArray, Response::HTTP_OK);
    }

    #[Route('/coffee-sizes', name: 'get_all_coffee_sizes', methods: ['GET'])]
    public function getSizes(): JsonResponse
    {
        $coffeeSizes = $this->coffeeService->getCoffeeSizes();

        $responseArray = CoffeeSizeMapper::toResponseArray($coffeeSizes);
        return $this->json($responseArray, Response::HTTP_OK);
    }
}
