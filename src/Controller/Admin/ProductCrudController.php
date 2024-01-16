<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Service\ApiService;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class ProductCrudController extends AbstractCrudController
{
    public function __construct(
        private readonly ApiService $apiService,
    ) {
    }

    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->onlyOnIndex();

        yield TextField::new('title')
            ->setRequired(true);

        yield TextareaField::new('description')
            ->setRequired(true);

        yield MoneyField::new('price')
            ->setCurrency('EUR')
            ->setRequired(true)
            ->setStoredAsCents(false);
    }
}
