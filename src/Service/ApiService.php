<?php


namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Psr\Log\LoggerInterface;

class ApiService
{
    private $httpClient;
    private $logger;

    public function __construct(HttpClientInterface $httpClient, LoggerInterface $logger)
    {
        $this->httpClient = $httpClient;
        $this->logger = $logger;
    }

    public function getProducts(): array
    {
        $response = $this->httpClient->request('GET', 'https://api.escuelajs.co/api/v1/products');
        return $response->toArray();
    }

    public function getProduct($id)
    {
        $response = $this->httpClient->request('GET', 'https://api.escuelajs.co/api/v1/products/' . $id);
        return $response->toArray();
    }

    public function getUsers()
    {
        $response = $this->httpClient->request('GET', 'https://api.escuelajs.co/api/v1/users');
        return $response->toArray();
    }

    public function getUser($id)
    {
        $response = $this->httpClient->request('GET', 'https://api.escuelajs.co/api/v1/users/' . $id);
        return $response->toArray();
    }

    public function getCategories(): array
    {

        $response = $this->httpClient->request('GET', 'https://api.escuelajs.co/api/v1/categories');
        return $response->toArray();
    }


    public function getCategory(string $id)
    {
        $response = $this->httpClient->request('GET', 'https://api.escuelajs.co/api/v1/categories/' . $id);
        return $response->toArray();
    }

    public function getProductsByCategoryId(string $id)
    {
        $response = $this->httpClient->request('GET', 'https://api.escuelajs.co/api/v1/products/?categoryId=' . $id);
        return $response->toArray();
    }
}
