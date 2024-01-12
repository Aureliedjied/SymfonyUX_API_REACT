<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiProperty;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
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
    private ?string $price = null;

    #[ApiProperty]
    #[Assert\NotBlank]
    #[ORM\Column]
    #[Groups('product:read')]
    private ?string $category = null;

    #[ApiProperty]
    #[Assert\NotBlank]
    #[ORM\Column]
    #[Groups('product:read')]
    private ?string $description = null;

    #[ApiProperty]
    #[Assert\NotBlank]
    #[ORM\Column]
    #[Groups('product:read')]
    private ?string $image = null;

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

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): static
    {
        $this->category = $category;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }
}
