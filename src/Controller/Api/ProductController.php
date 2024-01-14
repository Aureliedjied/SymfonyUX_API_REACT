<?php

namespace App\Controller\Api;

use App\Service\ApiService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    private $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    #[Route('/products', name: 'api_products', methods: ['GET'])]
    public function getProducts(): Response
    {
        // Utilisation du service ApiService pour récupérer les produits
        $products = $this->apiService->getProducts();
        // dump($products);
        return $this->render('product/index.html.twig', [
            'products' => $products,
        ]);
    }

    #[Route('/product/{id}', name: 'api_product', methods: ['GET'])]
    public function getProductById(int $id): Response
    {
        // Utilisation du service ApiService pour récupérer un produit par ID
        $product = $this->apiService->getProduct($id);

        return $this->render('product/show.html.twig', [
            'product' => $product,
        ]);
    }


    #[Route('/products/categorie/{category}', name: 'products_in_category', methods: ['GET'])]
    public function getProductsInCategory(int $id): Response
    {
        // Utilisation du service ApiService pour récupérer les produits d'une catégorie
        $products = $this->apiService->getCategory($id);

        return $this->render('product/in_category.html.twig', [
            'products' => $products,
        ]);
    }
}
