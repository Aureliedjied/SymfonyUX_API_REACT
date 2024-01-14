<?php

namespace App\Command;

use App\Entity\User;
use App\Entity\Product;
use App\Entity\Category;
use App\Service\ApiService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportCommand extends Command
{
    private ApiService $apiService;
    private EntityManagerInterface $entityManager;

    public function __construct(ApiService $apiService, EntityManagerInterface $entityManager)
    {
        parent::__construct();

        $this->apiService = $apiService;
        $this->entityManager = $entityManager;
    }

    protected function configure()
    {
        $this->setName('app:import')
            ->setDescription('Import data de l\API FakeStore');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Récupère les données de l'API
        $usersData = $this->apiService->getUsers();
        $productsData = $this->apiService->getProducts();
        $categoriesData = $this->apiService->getCategories();

        // Importe les utilisateurs
        foreach ($usersData as $userData) {
            // Crée et persiste les users avec les données de l'API
            $user = new User();
            $user->setEmail($userData['email']);
            $user->setName($userData['name']);
            $user->setRoles($userData['roles'] ?? []);
            $user->setPassword($userData['password']);
            $user->setAvatar($userData['avatar']);

            $this->entityManager->persist($user);
        }

        // Importe les catégories
        foreach ($categoriesData as $categoryData) {
            // Vérifie si la catégorie existe déjà
            $categoryId = $categoryData['id'];
            $existingCategory = $this->entityManager->getRepository(Category::class)->find($categoryId);

            if (!$existingCategory) {
                // Crée et persiste la catégorie si elle n'existe pas
                $category = new Category();
                $category->setName($categoryData['name']);
                $category->setImage($categoryData['image']);

                $this->entityManager->persist($category);
            }
        }

        // Exécute les opérations d'insertion dans la base de données pour les catégories
        $this->entityManager->flush();

        // Importe ensuite les produits
        foreach ($productsData as $productData) {
            // Crée et persiste un produit avec les données de l'API
            $product = new Product();
            $product->setTitle($productData['title']);
            $product->setDescription($productData['description']);
            $product->setPrice($productData['price']);
            $product->setImages($productData['images'] ?? []);

            // Assurez-vous que la clé "category" existe dans les données de l'API
            if (isset($productData['category']['id'])) {
                // Récupère la catégorie correspondante
                $categoryId = $productData['category']['id'];
                $category = $this->entityManager->getRepository(Category::class)->find($categoryId);

                if ($category) {
                    // Lie le produit à la catégorie
                    $product->setCategory($category);
                }
            }

            $this->entityManager->persist($product);
        }

        $this->entityManager->flush();

        $output->writeln('Import fait avec succès !');

        return Command::SUCCESS;
    }
}
