<?php

namespace App\Entity;

use App\Repository\SKURepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SKURepository::class)]
class SKU
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'SKUs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Seller $seller_id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSellerId(): ?Seller
    {
        return $this->seller_id;
    }

    public function setSellerId(?Seller $seller_id): self
    {
        $this->seller_id = $seller_id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
