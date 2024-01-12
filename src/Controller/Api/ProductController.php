<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/products', name: 'api_products', methods: ['GET'])]
    public function getProducts(): \Symfony\Component\HttpFoundation\Response
    {
        $client = HttpClient::create();
        $response = $client->request('GET', 'https://fakestoreapi.com/products');
        $data = $response->toArray();

        return $this->render('product/index.html.twig', [
            'products' => $data,
        ]);
    }
}
