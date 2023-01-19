<?php

namespace App\Entity;

use App\Repository\SellerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SellerRepository::class)]
class Seller
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'seller_id', targetEntity: SKU::class, orphanRemoval: true)]
    private Collection $SKUs;

    public function __construct()
    {
        $this->SKUs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, SKU>
     */
    public function getSKUs(): Collection
    {
        return $this->SKUs;
    }

    public function addSKUs(SKU $sKUs): self
    {
        if (!$this->SKUs->contains($sKUs)) {
            $this->SKUs->add($sKUs);
            $sKUs->setSellerId($this);
        }

        return $this;
    }

    public function removeSKUs(SKU $sKUs): self
    {
        if ($this->SKUs->removeElement($sKUs)) {
            // set the owning side to null (unless already changed)
            if ($sKUs->getSellerId() === $this) {
                $sKUs->setSellerId(null);
            }
        }

        return $this;
    }
}
