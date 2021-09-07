<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 * @ApiResource(
 *  normalizationContext={
 * "groups"={"categories_read", "markers_read"}
 *  }
 * )
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"categories_read"})
     * @Assert\NotBlank(message="Le Nom de la catégorie est Obligatoire")
     * @Assert\Length(min=3, minMessage="Le Nom de la catégorie doit au moins avoir 3 caractères", max=255, maxMessage="Le Nom de la catégorie ne peut contenir plus de 255 caractères")
     */
    private $nameCategory;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"categories_read", "markers_read"})
     * @Assert\NotBlank(message="Le Logo de la catégorie est Obligatoire")
     */
    private $logoCategory;

    /**
     * @ORM\Column(type="text")
     * @Groups({"categories_read", "markers_read"})
     * @Assert\NotBlank(message="Une Description pour la catégorie est Obligatoire")
     * @Assert\Length(min=15, minMessage="Le Nom de la catégorie doit au moins avoir 15 caractères")
     */
    private $descriptionCategory;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"categories_read", "markers_read"})
     * @Assert\NotBlank(message="Une Image pour la catégorie est Obligatoire")
     */
    private $imageCategory;

    /**
     * @ORM\OneToMany(targetEntity=Marker::class, mappedBy="category")
     * @Groups({"categories_read"})
     * @ApiSubresource
     */
    private $marker;

    public function __construct()
    {
        $this->marker = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameCategory(): ?string
    {
        return $this->nameCategory;
    }

    public function setNameCategory(string $nameCategory): self
    {
        $this->nameCategory = $nameCategory;

        return $this;
    }

    public function getLogoCategory(): ?string
    {
        return $this->logoCategory;
    }

    public function setLogoCategory(string $logoCategory): self
    {
        $this->logoCategory = $logoCategory;

        return $this;
    }

    public function getDescriptionCategory(): ?string
    {
        return $this->descriptionCategory;
    }

    public function setDescriptionCategory(string $descriptionCategory): self
    {
        $this->descriptionCategory = $descriptionCategory;

        return $this;
    }

    public function getImageCategory(): ?string
    {
        return $this->imageCategory;
    }

    public function setImageCategory(string $imageCategory): self
    {
        $this->imageCategory = $imageCategory;

        return $this;
    }

    /**
     * @return Collection|Marker[]
     */
    public function getMarker(): Collection
    {
        return $this->marker;
    }

    public function addMarker(Marker $marker): self
    {
        if (!$this->marker->contains($marker)) {
            $this->marker[] = $marker;
            $marker->setCategory($this);
        }

        return $this;
    }

    public function removeMarker(Marker $marker): self
    {
        if ($this->marker->removeElement($marker)) {
            // set the owning side to null (unless already changed)
            if ($marker->getCategory() === $this) {
                $marker->setCategory(null);
            }
        }

        return $this;
    }
}
