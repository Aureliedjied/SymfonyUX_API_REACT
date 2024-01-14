<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\File\File;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ApiResource]
#[ApiFilter(SearchFilter::class, properties: ['category' => 'exact'])]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('product:read')]
    private ?int $id = null;

    #[ApiProperty]
    #[NotBlank]
    #[ORM\Column]
    #[Groups('product:read')]
    private ?string $title = null;

    #[ApiProperty]
    #[Assert\NotBlank]
    #[ORM\Column]
    #[Groups('product:read')]
    private ?int $price = null;


    #[ApiProperty]
    #[Assert\NotBlank]
    #[ORM\Column(type: 'text')]
    #[Groups('product:read')]
    private ?string $description = null;

    #[ApiProperty]
    #[Assert\NotBlank]
    #[ORM\Column(type: 'json')]
    #[Groups('product:read')]
    private ?array $images = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    #[Groups('product:read')]
    private ?Category $category;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }


    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getImages(): ?array
    {
        return $this->images;
    }

    public function setImages(?array $images): self
    {
        $this->images = $images;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }
}
