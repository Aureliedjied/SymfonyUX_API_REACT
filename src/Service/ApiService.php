<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class ApiService
{
    private $httpClient;
    private $logger;

    // Constructeur avec injection de dépendances
    public function __construct(HttpClientInterface $httpClient, LoggerInterface $logger)
    {
        $this->httpClient = $httpClient;
        $this->logger = $logger;
    }

    // Récupère tous les produits
    public function getProducts(): array
    {
        try {
            $response = $this->httpClient->request('GET', 'https://api.escuelajs.co/api/v1/products');
            return $response->toArray();
        } catch (TransportExceptionInterface $e) {
            $this->logger->error('Erreur lors de la récupération des produits: ' . $e->getMessage());
            return [];
        }
    }

    // Récupère un produit spécifique par son ID
    public function getProduct($id)
    {
        try {
            $response = $this->httpClient->request('GET', 'https://api.escuelajs.co/api/v1/products/' . $id);
            return $response->toArray();
        } catch (TransportExceptionInterface $e) {
            $this->logger->error('Erreur lors de la récupération du produit: ' . $e->getMessage());
            return null;
        }
    }

    // Récupère tous les utilisateurs
    public function getUsers()
    {
        try {
            $response = $this->httpClient->request('GET', 'https://api.escuelajs.co/api/v1/users');
            return $response->toArray();
        } catch (TransportExceptionInterface $e) {
            $this->logger->error('Erreur lors de la récupération des utilisateurs: ' . $e->getMessage());
            return [];
        }
    }


    public function getUser($id)
    {
        try {
            $response = $this->httpClient->request('GET', 'https://api.escuelajs.co/api/v1/users/' . $id);
            return $response->toArray();
        } catch (TransportExceptionInterface $e) {
            $this->logger->error('Erreur lors de la récupération de l\utilisateur: ' . $e->getMessage());
            return null;
        }
    }


    public function getCategories(): array
    {
        try {
            $response = $this->httpClient->request('GET', 'https://api.escuelajs.co/api/v1/categories');
            return $response->toArray();
        } catch (TransportExceptionInterface $e) {
            $this->logger->error('Erreur lors de la récupération des catégories: ' . $e->getMessage());
            return null;
        }
    }


    public function getCategory(string $id)
    {
        try {
            $response = $this->httpClient->request('GET', 'https://api.escuelajs.co/api/v1/categories/' . $id);
            return $response->toArray();
        } catch (TransportExceptionInterface $e) {
            $this->logger->error('Erreur lors de la récupération de la catégorie: ' . $e->getMessage());
            return null;
        }
    }


    public function getProductsByCategoryId(string $id)
    {
        $response = $this->httpClient->request('GET', 'https://api.escuelajs.co/api/v1/products/?categoryId=' . $id);
        return $response->toArray();
    }

    public function getProductsByPriceRange(int $priceMin, int $priceMax): array
    {
        // les paramètres de la requête pour filtrer les produits par prix
        $response = $this->httpClient->request('GET', 'https://api.escuelajs.co/api/v1/products/', [
            'query' => [
                'price_min' => $priceMin,
                'price_max' => $priceMax,
            ],
        ]);

        return $response->toArray();
    }
}
