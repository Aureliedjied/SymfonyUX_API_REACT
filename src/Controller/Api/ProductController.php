<?php

namespace App\Controller\Api;

use App\Service\ApiService;
use Symfony\Component\HttpFoundation\Request;
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
        $categories = $this->apiService->getCategories();

        return $this->render('product/index.html.twig', [
            'products' => $products,
            'categories' => $categories
        ]);
    }

    #[Route('/product/{id}', name: 'api_product', methods: ['GET'])]
    public function getProductById(int $id): Response
    {
        // Utilisation du service ApiService pour récupérer un produit par ID
        $product = $this->apiService->getProduct($id);
        $categories = $this->apiService->getCategories();

        return $this->render('product/show.html.twig', [
            'product' => $product,
            'categories' => $categories
        ]);
    }


    #[Route('/products/category/{id}', name: 'products_in_category', methods: ['GET'])]
    public function getProductsByCategory(int $id): Response
    {
        // Utilisation du service ApiService pour récupérer les produits d'une catégorie
        $products = $this->apiService->getProductsByCategoryId($id);
        $categories = $this->apiService->getCategories();
        $category = $this->apiService->getCategory($id);

        return $this->render('product/in_category.html.twig', [
            'products' => $products,
            'categories' => $categories,
            'categoryId' => $id,
            'category' => $category
        ]);
    }

    // Route pour filtrer les produits par prix
    #[Route('/products/filter', name: 'api_products_filter', methods: ['GET'])]
    public function filterProductsByPriceRange(Request $request): Response
    {
        // Récupérer les valeurs du prix min et max depuis la requête de l'utilisateur
        $priceMin = $request->query->getInt('price_min');
        $priceMax = $request->query->getInt('price_max');

        // Utilisation du service ApiService pour récupérer les produits en fonction de la plage de prix
        $filteredProducts = $this->apiService->getProductsByPriceRange($priceMin, $priceMax);
        $categories = $this->apiService->getCategories();

        return $this->render('product/index.html.twig', [
            'products' => $filteredProducts,
            'categories' => $categories,
            'priceMin' => $priceMin,
            'priceMax' => $priceMax,
        ]);
    }
}
