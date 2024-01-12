<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Product;
use App\Service\ApiService;
use PhpParser\Node\Expr\Yield_;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{

    public function __construct(
        private readonly AdminUrlGenerator $adminUrlGenerator
    ) {
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator
            ->setController(ProductCrudController::class)
            ->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Admin');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-list', User::class);
        yield MenuItem::linkToCrud('Tous les Produits', 'fas fa-list', Product::class);
    }
}
// private ApiService $apiService;

// public function __construct(ApiService $apiService)
// {
//     $this->apiService = $apiService;
// }

// #[Route('/admin', name: 'admin')]
// public function index(): Response
// {
//     $products = $this->apiService->getProducts();
//     $users = $this->apiService->getUsers();

//     return $this->render('admin/index.html.twig', [
//         'products' => $products,
//         'users' => $users,
//     ]);
// }