<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\MarkerRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=MarkerRepository::class)
 * @ApiResource(
 * subresourceOperations={
 *  "api_categories_markers_get_subresource"={
 *  "normalization_context"={"groups"={"markers_subresource"}}
 * }
 * },
 *  normalizationContext={
 * "groups"={"markers_read", "categories_read"}
 *  }
 * )
 * @ApiFilter(SearchFilter::class, properties={"nameMarker":"partial"})
 */
class Marker
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"markers_read", "categories_read", "markers_subresource"})
     * @Assert\NotBlank(message="Le Marker doit avoir un nom")
     * @Assert\Length(min=3, minMessage="Le Nom du Marker doit au moins avoir 3 caractères", max=255, maxMessage="Le Nom du Marker ne peut contenir plus de 255 caractères")
     */
    private $nameMarker;

    /**
     * @ORM\Column(type="text")
     * @Groups({"markers_read", "categories_read", "markers_subresource"})
     * @Assert\NotBlank(message="Le Marker doit avoir une description")
     */
    private $descriptionMarker;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"markers_read"})
     * @Assert\NotBlank(message="Le Marker doit avoir une adresse")
     */
    private $addressMarker;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"markers_read"})
     */
    private $siteInternetMarker;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"markers_read"})
     * @Assert\NotBlank(message="Le Marker doit avoir un lien vers google afin de faciliter l'utilisation de Google Map")
     */
    private $linkGoogleMap;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"markers_read"})
     * @Assert\NotBlank(message="Le Marker doit avoir au moins une image")
     */
    private $imageMarker;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le Marker doit avoir une Longitude, c'est important pour afficher le point sur la Map")
     */
    private $longitudeMarker;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le Marker doit avoir une Latitude, c'est important pour afficher le point sur la Map")
     */
    private $latitudeMarker;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="marker")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="Vous ne pouvez creer un point sans lui attribuer une Categorie")
     */
    private $category;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameMarker(): ?string
    {
        return $this->nameMarker;
    }

    public function setNameMarker(string $nameMarker): self
    {
        $this->nameMarker = $nameMarker;

        return $this;
    }

    public function getDescriptionMarker(): ?string
    {
        return $this->descriptionMarker;
    }

    public function setDescriptionMarker(string $descriptionMarker): self
    {
        $this->descriptionMarker = $descriptionMarker;

        return $this;
    }

    public function getAddressMarker(): ?string
    {
        return $this->addressMarker;
    }

    public function setAddressMarker(string $addressMarker): self
    {
        $this->addressMarker = $addressMarker;

        return $this;
    }

    public function getSiteInternetMarker(): ?string
    {
        return $this->siteInternetMarker;
    }

    public function setSiteInternetMarker(?string $siteInternetMarker): self
    {
        $this->siteInternetMarker = $siteInternetMarker;

        return $this;
    }

    public function getLinkGoogleMap(): ?string
    {
        return $this->linkGoogleMap;
    }

    public function setLinkGoogleMap(string $linkGoogleMap): self
    {
        $this->linkGoogleMap = $linkGoogleMap;

        return $this;
    }

    public function getImageMarker(): ?string
    {
        return $this->imageMarker;
    }

    public function setImageMarker(string $imageMarker): self
    {
        $this->imageMarker = $imageMarker;

        return $this;
    }

    public function getLongitudeMarker(): ?string
    {
        return $this->longitudeMarker;
    }

    public function setLongitudeMarker(string $longitudeMarker): self
    {
        $this->longitudeMarker = $longitudeMarker;

        return $this;
    }

    public function getLatitudeMarker(): ?string
    {
        return $this->latitudeMarker;
    }

    public function setLatitudeMarker(string $latitudeMarker): self
    {
        $this->latitudeMarker = $latitudeMarker;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
