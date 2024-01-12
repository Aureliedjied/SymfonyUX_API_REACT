<?php

namespace App\Controller\Api;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    #[Route('/products', name: 'api_products', methods: ['GET'])]
    public function getProducts(): \Symfony\Component\HttpFoundation\Response
    {
        //ici on va faire une requete http pour recuperer les produits
        $client = HttpClient::create();
        //on fait une requete get sur l'url de l'api
        $response = $client->request('GET', 'https://fakestoreapi.com/products');
        //on recupere les données de la reponse
        $data = $response->toArray();

        return $this->render('product/index.html.twig', [
            'products' => $data,
        ]);
    }

    #[Route('/api/product/{id}', name: 'api_product', methods: ['GET'])]
    public function getProductById(int $id): Response
    {
        $client = HttpClient::create();
        $response = $client->request('GET', "https://fakestoreapi.com/products/{$id}");
        $product = $response->toArray();

        return $this->render('product/show.html.twig', [
            'product' => $product,
        ]);
    }
}
