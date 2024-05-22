<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ArticleRepository;

class ArticleController extends AbstractController
{
    public function __construct() {
    }

    #[Route('/articles', name: 'get_article', methods: ['GET'])]
    public function getArticles(ArticleRepository $articleRepository): JsonResponse
    {

        $articles = $articleRepository->findAll();

        return $this->json($articles, 200, [], ['groups' => ['articleList']]);
    }
}
