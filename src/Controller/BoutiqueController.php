<?php

namespace App\Controller;

use App\Repository\StockRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class BoutiqueController extends AbstractController
{
    #[Route('/boutique/{id}/infos', name: 'get_boutique_info', methods: ['GET'])]
    public function index(int $id, StockRepository $stockRepository, SerializerInterface $serializer): JsonResponse
    {
        $stocks = $stockRepository->findAll();
        $responseData = [
            'id' => $id,
            'stock' => $stocks
        ];

        return $this->json($responseData, 200, [], ['groups' => ['boutiqueInfo', 'articleList']]);
    }
}
