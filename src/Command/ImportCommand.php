<?php

namespace App\Command;

use App\Entity\User;
use App\Entity\Product;
use App\Service\ApiService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportCommand extends Command
{
    private ApiService $ApiService;
    private EntityManagerInterface $entityManager;

    public function __construct(ApiService $ApiService, EntityManagerInterface $entityManager)
    {
        parent::__construct();

        $this->ApiService = $ApiService;
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
        $usersData = $this->ApiService->getUsers();
        $productsData = $this->ApiService->getProducts();

        // Importe les utilisateurs
        foreach ($usersData as $userData) {
            // Crée et persiste un nouvel utilisateur avec les données de l'API
            $user = new User();
            $user->setEmail($userData['email']);
            $user->setUsername($userData['username']);
            $user->setFirstName($userData['name']['firstname']);
            $user->setLastName($userData['name']['lastname']);
            $user->setRoles($userData['roles'] ?? []);
            $user->setPassword($userData['password']);

            // Ajoute les propriétés d'adresse
            if (isset($userData['address'])) {
                $user->setCity($userData['address']['city']);
                $user->setStreet($userData['address']['street']);
                $user->setNumber($userData['address']['number']);
                $user->setZipcode($userData['address']['zipcode']);
                // Utilisation de l'opérateur ?? pour définir une valeur par défaut si la clé "latitude" n'est pas définie
                $user->setLatitude($userData['address']['geolocation']['lat'] ?? null);

                // Utilisation de l'opérateur ?? pour définir une valeur par défaut si la clé "longitude" n'est pas définie
                $user->setLongitude($userData['address']['geolocation']['long'] ?? null);
            }

            foreach ($productsData as $productData) {
                // Crée et persiste un nouveau produit avec les données de l'API
                $product = new Product();
                $product->setTitle($productData['title']);
                $product->setDescription($productData['description']);
                $product->setPrice($productData['price']);
                $product->setCategory($productData['category']);

                // Ajoute les propriétés d'image
                if (isset($productData['image'])) {
                    $product->setImage($productData['image']);
                }

                $this->entityManager->persist($product);
            }

            $this->entityManager->persist($user);
        }
        $this->entityManager->flush();

        $output->writeln('Import fait avec succés !');

        return Command::SUCCESS;
    }
}
