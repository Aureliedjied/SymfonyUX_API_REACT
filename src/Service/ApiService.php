<?php


namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;

class ApiService
{
    private $httpClient;

    public function __construct()
    {
        $this->httpClient = HttpClient::create();
    }

    public function getProducts()
    {
        $response = $this->httpClient->request('GET', 'https://fakestoreapi.com/products');
        return $response->toArray();
    }

    public function getProduct($id)
    {
        $response = $this->httpClient->request('GET', 'https://fakestoreapi.com/products/' . $id);
        return $response->toArray();
    }

    public function getUsers()
    {
        $response = $this->httpClient->request('GET', 'https://fakestoreapi.com/users');
        $users = $response->toArray();

        foreach ($users as &$user) {
            // Vérifie si la clé "latitude" est définie avant de l'utiliser
            $user['latitude'] = $user['address']['geolocation']['latitude'] ?? null;

            // Vérifie si la clé "longitude" est définie avant de l'utiliser
            $user['longitude'] = $user['address']['geolocation']['longitude'] ?? null;
        }

        return $users;
    }

    public function getUser($id)
    {
        $response = $this->httpClient->request('GET', 'https://fakestoreapi.com/users/' . $id);
        return $response->toArray();
    }
}
