<?php

namespace App\Entity;

use App\Repository\SubcategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubcategoryRepository::class)]
class Subcategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Nft::class, inversedBy: 'subcategories')]
    private Collection $ntfs;

    #[ORM\ManyToOne(inversedBy: 'subcategories')]
    private ?Category $category = null;

    public function __construct()
    {
        $this->ntfs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Nft>
     */
    public function getNtfs(): Collection
    {
        return $this->ntfs;
    }

    public function addNtf(Nft $ntf): static
    {
        if (!$this->ntfs->contains($ntf)) {
            $this->ntfs->add($ntf);
        }

        return $this;
    }

    public function removeNtf(Nft $ntf): static
    {
        $this->ntfs->removeElement($ntf);

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
