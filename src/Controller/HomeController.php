<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{

    #[Route('/', name: 'app_home')]
    public function home(): Response
    {
        // Rendre la vue avec les catégories
        return $this->render('home/index.html.twig');
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        // Rendre la vue avec les catégories
        return $this->render('pages/contact.html.twig');
    }

    #[Route('/apropos', name: 'app_about')]
    public function about(): Response
    {
        // Rendre la vue avec les catégories
        return $this->render('pages/about.html.twig');
    }
}
