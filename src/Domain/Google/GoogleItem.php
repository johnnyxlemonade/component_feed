<?php declare(strict_types=1);

namespace Lemonade\Feed\Domain\Google;

use Lemonade\Feed\Domain\DomainItemInterface;
use Symfony\Component\Validator\Constraints as Assert;

final class GoogleItem implements DomainItemInterface
{
    #[Assert\NotBlank]
    private string $itemId;

    #[Assert\NotBlank]
    private string $productName;

    #[Assert\NotBlank]
    private string $description;

    #[Assert\NotBlank]
    #[Assert\Url]
    private string $url;

    /** @var GoogleShipping[] */
    private array $deliveries = [];

    /** @var GoogleImage[] */
    private array $images = [];

    private ?string $condition = null;
    private ?string $availability = null;

    #[Assert\NotBlank]
    private float $price;

    #[Assert\NotBlank]
    private string $currency;

    private ?float $salePrice = null;
    private bool $identifierExists = true;
    private ?string $gtin = null;
    private ?string $mpn = null;
    private ?string $brand = null;

    /** @var GoogleProductType[] */
    private array $productTypes = [];

    private ?string $availabilityDate = null;
    private ?string $googleProductCategory = null;
    private ?string $itemGroupId = null;

    public function __construct(
        string $itemId,
        string $productName,
        string $description,
        string $url,
        float $price,
        string $currency
    ) {
        $this->itemId       = $itemId;
        $this->productName  = $productName;
        $this->description  = $description;
        $this->url          = $url;
        $this->price        = $price;
        $this->currency     = $currency;
    }

    // --- adders ---
    public function addShipping(GoogleShipping $shipping): self
    {
        $this->deliveries[] = $shipping;
        return $this;
    }

    public function addImage(GoogleImage $image): self
    {
        $this->images[] = $image;
        return $this;
    }

    public function addProductType(GoogleProductType $type): self
    {
        $this->productTypes[] = $type;
        return $this;
    }

    // --- setters ---
    public function setCondition(?string $condition): self { $this->condition = $condition; return $this; }
    public function setAvailability(?string $availability): self { $this->availability = $availability; return $this; }
    public function setSalePrice(?float $salePrice): self { $this->salePrice = $salePrice; return $this; }
    public function setIdentifierExists(bool $exists): self { $this->identifierExists = $exists; return $this; }
    public function setGtin(?string $gtin): self { $this->gtin = $gtin; return $this; }
    public function setMpn(?string $mpn): self { $this->mpn = $mpn; return $this; }
    public function setBrand(?string $brand): self { $this->brand = $brand; return $this; }
    public function setAvailabilityDate(?string $date): self { $this->availabilityDate = $date; return $this; }
    public function setGoogleProductCategory(?string $cat): self { $this->googleProductCategory = $cat; return $this; }
    public function setItemGroupId(?string $id): self { $this->itemGroupId = $id; return $this; }

    // --- getters ---
    public function getId(): string { return $this->itemId; }
    public function getTitle(): string { return $this->productName; }
    public function getDescription(): string { return $this->description; }
    public function getLink(): string { return $this->url; }
    public function getPrice(): float { return $this->price; }
    public function getCurrency(): string { return $this->currency; }

    /** @return GoogleShipping[] */
    public function getShippings(): array { return $this->deliveries; }

    /** @return GoogleImage[] */
    public function getImages(): array { return $this->images; }

    public function getCondition(): ?string { return $this->condition; }
    public function getAvailability(): ?string { return $this->availability; }
    public function getSalePrice(): ?float { return $this->salePrice; }
    public function getIdentifierExists(): bool { return $this->identifierExists; }
    public function getGtin(): ?string { return $this->gtin; }
    public function getMpn(): ?string { return $this->mpn; }
    public function getBrand(): ?string { return $this->brand; }

    /** @return GoogleProductType[] */
    public function getProductTypes(): array { return $this->productTypes; }

    public function getAvailabilityDate(): ?string { return $this->availabilityDate; }
    public function getGoogleProductCategory(): ?string { return $this->googleProductCategory; }
    public function getItemGroupId(): ?string { return $this->itemGroupId; }
}
